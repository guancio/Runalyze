<?php

namespace Runalyze\plugin\panel\ZieleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RunalyzePanelZieleBundle::index.html.twig');
    }
}
