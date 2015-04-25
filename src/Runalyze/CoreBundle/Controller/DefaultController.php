<?php

namespace Runalyze\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Runalyze\CoreBundle\Entity\Account;
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RunalyzeCoreBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/impressum")
     */
    public function impressumAction()
    {
        return $this->render('RunalyzeCoreBundle:Default:impressum.html.twig');
    }
    
    /**
    * @Route("/privacy")
    */
    public function privacyAction()
    {
        return $this->render('RunalyzeCoreBundle:Default:privacy.html.twig');
    }
}
