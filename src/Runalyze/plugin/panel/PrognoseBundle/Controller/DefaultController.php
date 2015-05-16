<?php

namespace Runalyze\plugin\panel\PrognoseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RunalyzePanelPrognoseBundle::index.html.twig');
    }
}
