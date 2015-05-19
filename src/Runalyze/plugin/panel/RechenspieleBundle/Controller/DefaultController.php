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
        dump($confData);
        $VDOT        = $confData['VDOT_FORM'];
        $ATLmax      = $confData['MAX_ATL'];
        $CTLmax      = $confData['MAX_CTL'];
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
