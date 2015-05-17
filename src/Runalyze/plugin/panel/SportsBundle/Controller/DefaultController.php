<?php

namespace Runalyze\plugin\panel\SportsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RunalyzePanelSportsBundle::index.html.twig');
    }
}
