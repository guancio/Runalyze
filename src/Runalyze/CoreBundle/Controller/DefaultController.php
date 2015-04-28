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
       /* $qb = $entityManager->createQueryBuilder();
        $qb->select('count(account.id)');
        $qb->from('RunalyzeCoreBundle:Account','account');
        $count = $qb->getQuery()->getSingleScalarResult();
*/
        return $this->render('RunalyzeCoreBundle:Default:userstats.html.twig');
    }
}
