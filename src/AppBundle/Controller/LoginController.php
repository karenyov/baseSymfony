<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use SysadminBundle\Entity\User;

/**
 * Description of LoginController
 *
 * @author Karen
 */
class LoginController extends Controller {

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request) {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('AppBundle:login:index.html.twig', array('last_username' => $lastUsername, 'error' => $error));
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction(Request $request) {
        return $this->render('AppBundle:index:index.html.twig');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutCheckAction() {
        return $this->render('AppBundle:index:index.html.twig');
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request) {
        $user = new User();
        $form = $this->createForm('AppBundle\Form\LoginType', $user);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user = $this->getDoctrine()->getRepository('SysadminBundle:User')->insert($user);
            // automatic login user
            $providerKey = 'secured_area'; // Name of firewall
            $token = new UsernamePasswordToken($user, null, $providerKey, array('AUTO_LOGIN'));
            $this->container->get('security.token_storage')->setToken($token);
            return $this->redirect($this->generateUrl('index'));
        }
        return $this->render('AppBundle:login:register.html.twig', array('form' => $form->createView())
        );
    }

}
