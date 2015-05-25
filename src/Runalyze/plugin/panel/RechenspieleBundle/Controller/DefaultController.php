<?php

namespace Runalyze\plugin\panel\RechenspieleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Runalyze\Calculation\JD\VDOT;
use Runalyze\Calculation\JD\VDOTCorrector;
use Runalyze\Activity\Distance;
use Runalyze\Activity\Duration;
use Runalyze\Calculation\Performance;
use Runalyze\Calculation\Trimp;
use Runalyze\Calculation\Monotony;
use Runalyze\Calculation\BasicEndurance;

class DefaultController extends Controller
{
    /**
    * @Security("has_role('ROLE_USER')")
    * @Route("/", name="PanelRechenspiele")
    */
    public function indexAction()
    {
        $confData = $this->get('runalyze.conf')->getCategory('data');
        $confTrimp = $this->get('runalyze.conf')->getCategory('trimp');
        $this->get('runalyze.performance.model')->execute();
dump($confTrimp);
        $TSBmodel = new Performance\TSB(
                $this->get('runalyze.performance.model')->data(),
                $confTrimp['CTL_DAYS'],
                $confTrimp['ATL_DAYS']
        );
        $TSBmodel->calculate();    
        
        $VDOT        = $confData['VDOT_FORM'];
        $ATLmax      = $confData['MAX_ATL'];
        $CTLmax      = $confData['MAX_CTL'];
        $ModelATLmax = $TSBmodel->maxFatigue();
        $ModelCTLmax = $TSBmodel->maxFitness();
        $ATLabsolute = $TSBmodel->fatigueAt(0);
        $CTLabsolute = $TSBmodel->fitnessAt(0);
        $TSBabsolute = $TSBmodel->performanceAt(0);
        
        if ($ModelATLmax > $ATLmax) {
            $this->get('runalyze.conf')->set('data', 'MAX_ATL', $ModelATLmax);
            $ATLmax = $ModelATLmax;
        }

        if ($ModelCTLmax > $CTLmax) {
            $this->get('runalyze.conf')->set('data', 'MAX_CTL', $ModelCTLmax);
            $CTLmax = $ModelCTLmax;
        }
        
        $MonotonyQuery = $this->get('runalyze.performance.model');
        $MonotonyQuery->setRange(time()-(Monotony::DAYS-1)*86400, time());
        $MonotonyQuery->execute();
        $Monotony = new Monotony($MonotonyQuery->data());
        $Monotony->calculate();
                dump($Monotony->valueAsPercentage());
                dump($Monotony->trainingStrainAsPercentage($ATLmax));
        

        
        $TrimpValues = array(
                'ATL'		=> round(100*$ATLabsolute/$ATLmax),
                'ATLstring'	=> $confTrimp['TRIMP_MODEL_IN_PERCENT'] ? round(100*$ATLabsolute/$ATLmax) : $ATLabsolute,
                'CTL'		=> round(100*$CTLabsolute/$CTLmax),
                'CTLstring'	=> $confTrimp['TRIMP_MODEL_IN_PERCENT'] ? round(100*$CTLabsolute/$CTLmax) : $CTLabsolute,
                'TSB'		=> round(100*$TSBabsolute/max($ATLabsolute, $CTLabsolute)),
                'TSBstring'	=> $confTrimp['TRIMP_MODEL_IN_PERCENT'] ? sprintf("%+d", round(100*$TSBabsolute/max($ATLabsolute, $CTLabsolute))).'%' : sprintf("%+d", $TSBabsolute),
        );
        $TSBisPositive = $TrimpValues['TSB'] > 0;
        $maxTrimpToBalanced = ceil($TSBmodel->maxTrimpToBalanced($CTLabsolute, $ATLabsolute));
        $restDays = ceil($TSBmodel->restDays($CTLabsolute, $ATLabsolute));
        $Values = array(
            'vdot'=>array('value' => number_format($VDOT, 2),
                          'bar' => ''),
            'basicEndurance'=> array('value'=> 'test',
                                     'bar' => ''),
            'atl'=> array('value'=> $TrimpValues['ATLstring'],
                        'bar' => $TrimpValues['ATL']),
            'ctl'=> array('value'=> $TrimpValues['CTLstring'],
                'bar' => $TrimpValues['CTL']),
            'tsb'=> array('value'=> $TrimpValues['TSBstring'],
                'bar' => $TrimpValues['TSB']),
            'restdays'=> array('value'=> $restDays,
                'bar' => ''),
            'easytrimp'=> array('value'=> $maxTrimpToBalanced,
                'bar' => ''),
            'monotony'=> array('value'=> number_format($Monotony->value(), 2),
                'bar' => ''),
            'trainingstrain'=> array('value'=> round($Monotony->trainingStrain()),
                'bar' => ''),
            'trainingpoints'=> array('value'=> 'test',
                'bar' => ''),
        );
        dump($Values);
        return $this->render('RunalyzePanelRechenspieleBundle::index.html.twig',
                array('values' => $Values));
    }
    
    /**
    * @Route("/info", name="PanelRechenspiele_info")
    */
    public function infoAction()
    {
        return $this->render('RunalyzePanelRechenspieleBundle::info.html.twig');
    }
    
    
    /**
    * @Route("/explanation", name="PanelRechenspiele_explanation")
    */
    public function explanationAction()
    {
        return $this->render('RunalyzePanelRechenspieleBundle::explanation.html.twig');
    }
    
    /**
    * @Route("/form", name="PanelRechenspiele_form")
    */
    public function formAction()
    {
        return $this->render('RunalyzePanelRechenspieleBundle::form.html.twig');
    }
    
    /**
    * @Route("/config", name="PanelRechenspiele_config")
    * @Security("has_role('ROLE_USER')")
    */
    public function configAction(Request $request)
    {
        $defaultData = array('message' => 'Type your message here');
        $form = $this->createFormBuilder($defaultData)
            ->add('show_trainingpaces', 'checkbox', array(
                    'label'    => 'Show: Paces',
                    'required' => false,
                ))
            ->add('show_trimpvalues', 'checkbox', array(
                'label'    => 'Show: ATL/CTL/TSB',
                'required' => false,
            ))
            ->add('show_trimpvalues_extra', 'checkbox', array(
                'label'    => 'Show: Monotony/TS',
                'required' => false,
            ))
            ->add('show_vdot', 'checkbox', array(
                'label'    => 'Show: VDOT',
                'required' => false,
            ))
            ->add('show_basicendurance', 'checkbox', array(
                'label'    => 'Show: Basic endurance',
                'required' => false,
            ))
            ->add('show_jd_intensity', 'checkbox', array(
                'label'    => 'Show: Training points',
                'required' => false,
            ))
            ->add('Edit', 'submit')
            ->getForm();
         $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
        }

            return $this->render('RunalyzePanelRechenspieleBundle::config.html.twig',
                    array(
                    'form' => $form->createView()));
    }
}
