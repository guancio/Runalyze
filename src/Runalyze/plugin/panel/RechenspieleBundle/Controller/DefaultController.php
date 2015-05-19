<?php

namespace Runalyze\plugin\panel\RechenspieleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RunalyzePanelRechenspieleBundle::index.html.twig');
    }
    
    /**
    * @Route("/info", name="Rechenspiele_info")
    */
    public function infoAction()
    {
        return $this->render('RunalyzePanelRechenspieleBundle::info.html.twig');
    }
}
