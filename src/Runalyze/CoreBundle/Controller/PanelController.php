<?php

namespace Runalyze\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class PanelController extends Controller
{
    public function indexAction()
    {
        //Get Panelplugins of user and loop through each panel controller
        $response = $this->forward('RunalyzePanelPrognoseBundle:Default:index');
        return $response;
    }
}
