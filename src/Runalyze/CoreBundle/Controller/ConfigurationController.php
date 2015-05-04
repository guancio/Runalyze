<?php

namespace Runalyze\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class ConfigurationController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/", name="configuration")
     */
    public function indexAction()
    {

            return $this->render('RunalyzeCoreBundle:Configuration:index.html.twig');

    }

}
