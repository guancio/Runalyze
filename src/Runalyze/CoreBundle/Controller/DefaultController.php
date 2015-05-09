<?php

namespace Runalyze\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="start")
     */
    public function indexAction()
    {

            $authenticationUtils = $this->get('security.authentication_utils');

            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();

            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('RunalyzeCoreBundle:Security:login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
            ));

    }

    /**
    * @Security("has_role('ROLE_USER')")
    * @Route("/", name="start")
    */
   public function appAction()
   {
       return $this->render('RunalyzeCoreBundle:Default:app.html.twig');
   }   
    
    /**
     * @Route("/impressum", name="impressum")
     */
    public function impressumAction()
    {
        return $this->render('RunalyzeCoreBundle:Default:impressum.html.twig');
    }
    
    /**
    * @Route("/privacy", name="privacy")
    */
    public function privacyAction()
    {
        return $this->render('RunalyzeCoreBundle:Default:privacy.html.twig');
    }
    
    public function UserStatsAction()
    {
        $em = $this->getDoctrine()->getManager();
        //Count Users
        $users = $em->createQueryBuilder()
                        ->select('count(account.id)')
                        ->from('RunalyzeCoreBundle:Account','account')
                        ->getQuery()
                        ->getSingleScalarResult();
        // Get all kilometers of all users
        $userkm = $em->createQueryBuilder()
                        ->select('sum(training.distance)')
                        ->from('RunalyzeCoreBundle:Training','training')
                        ->getQuery()
                        ->getSingleScalarResult();
        $userkm = (!empty($userkm) ? $userkm : '0,00' );
        
        // TODO - get current logged in users
  
       
        return $this->render('RunalyzeCoreBundle:Default:userstats.html.twig',
                array('users' => $users, 
                      'userkm' => $userkm));
    }
    
    /**
    * @Security("has_role('ROLE_USER')")
    * @Route("/help", name="help")
    */
    public function helpAction()
    {
        return $this->render('RunalyzeCoreBundle:Default:help.html.twig');
    }
}
