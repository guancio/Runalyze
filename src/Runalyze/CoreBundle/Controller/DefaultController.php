<?php

namespace Runalyze\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Runalyze\CoreBundle\Entity\Account;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('RunalyzeCoreBundle:Default:index.html.twig',
        array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
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
}
