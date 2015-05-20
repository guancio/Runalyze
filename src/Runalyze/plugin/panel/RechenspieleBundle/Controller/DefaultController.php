<?php

namespace Runalyze\plugin\panel\RechenspieleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Runalyze\Calculation\JD\VDOT;
use Runalyze\Calculation\JD\VDOTCorrector;
use Runalyze\Activity\Distance;
use Runalyze\Activity\Duration;
use Runalyze\Calculation\Performance;
use Runalyze\Calculation\Trimp;
use Runalyze\Calculation\Monotony;

class DefaultController extends Controller
{
    /**
    * @Route("/", name="PanelRechenspiele")
    */
    public function indexAction()
    {
        $confData = $this->get('runalyze.conf')->getCategory('data');
        $confTrimp = $this->get('runalyze.conf')->getCategory('trimp');
        $this->get('runalyze.performance.model')->execute();
        
        $TSBmodel = new Performance\TSB(
                $this->get('runalyze.performance.model')->data(),
                $confTrimp['CTL_DAYS'],
                $confTrimp['ATL_DAYS']
        );
      dump($confTrimp);
        $TSBmodel->calculate();    
        
        $VDOT        = $confData['VDOT_FORM'];
        $ATLmax      = $confData['MAX_ATL'];
        $CTLmax      = $confData['MAX_CTL'];
        $ModelATLmax = $TSBmodel->maxFatigue();
        $ModelCTLmax = $TSBmodel->maxFitness();
        $ATLabsolute = $TSBmodel->fatigueAt(0);
        $CTLabsolute = $TSBmodel->fitnessAt(0);
        $TSBabsolute = $TSBmodel->performanceAt(0);
      /*  $TrimpValues = array(
                'ATL'		=> round(100*$ATLabsolute/$ATLmax),
                'ATLstring'	=> $confTrimp['TRIMP_MODEL_IN_PERCENT'] ? round(100*$ATLabsolute/$ATLmax).'&nbsp;&#37;' : $ATLabsolute,
                'CTL'		=> round(100*$CTLabsolute/$CTLmax),
                'CTLstring'	=> $confTrimp['TRIMP_MODEL_IN_PERCENT'] ? round(100*$CTLabsolute/$CTLmax).'&nbsp;&#37;' : $CTLabsolute,
                'TSB'		=> round(100*$TSBabsolute/max($ATLabsolute, $CTLabsolute)),
                'TSBstring'	=> $confTrimp['TSB_IN_PERCENT'] ? sprintf("%+d", round(100*$TSBabsolute/max($ATLabsolute, $CTLabsolute))).'&nbsp;&#37;' : sprintf("%+d", $TSBabsolute),
        );*/

        return $this->render('RunalyzePanelRechenspieleBundle::index.html.twig');
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
    */
    public function configAction()
    {
        return $this->render('RunalyzePanelRechenspieleBundle::config.html.twig');
    }
}
