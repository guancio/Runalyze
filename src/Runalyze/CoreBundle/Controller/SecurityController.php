<?php
namespace Runalyze\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Runalyze\CoreBundle\Form\Type\RegistrationType;
use Runalyze\CoreBundle\Form\Model\Registration;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login_route")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'RunalyzeCoreBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }
    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        // this controller will not be executed,
        // as the route is handled by the Security system
    }
    
    /**
     * @Route("/signup", name="register_route")
     */
    public function registerAction()
    {
        $registration = new Registration();
        $form = $this->createForm(new RegistrationType(), $registration, array(
            'action' => $this->generateUrl('account_create'),
        ));
        return $this->render(
        'RunalyzeCoreBundle:Security:register.html.twig',
            array('form' => $form->createView()));
    }
    /**
     * @Route("/signup/create", name="account_create")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new RegistrationType(), new Registration());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $registration = $form->getData();

            $em->persist($registration->getAccount());
            $em->flush();

            //return $this->redirectToRoute(...);
        }

        return $this->render(
            'RunalyzeCoreBundle:Security:register.html.twig',
            array('form' => $form->createView())
        );
    } 
}
