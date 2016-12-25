<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Description of LoginController
 *
 * @author Karen
 */
class LoginController extends Controller {

    /**
     * @Route("/login", name="login")
     */
    public function indexAction() {
        return $this->render('AppBundle:login:index.html.twig');
    }

}
