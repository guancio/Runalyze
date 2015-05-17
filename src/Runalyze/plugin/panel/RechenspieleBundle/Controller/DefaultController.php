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
}
