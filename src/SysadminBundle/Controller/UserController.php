<?php

namespace SysadminBundle\Controller;

use SysadminBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 * @Route("user")
 */
class UserController extends Controller {

    /**
     * Lists all user entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('SysadminBundle:User')->listAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $users, $request->query->getInt('page', 1), 10
        );

        return $this->render('SysadminBundle:user:index.html.twig', array(
                    'pagination' => $pagination,
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $user = new User();
        $form = $this->createForm('SysadminBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $user = $this->getDoctrine()->getRepository('SysadminBundle:User')->insert($user);

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('SysadminBundle:user:new.html.twig', array(
                    'user' => $user,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user) {
        $editForm = $this->createForm('SysadminBundle\Form\UserEdit', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('SysadminBundle:user:edit.html.twig', array(
                    'user' => $user,
                    'edit_form' => $editForm->createView(),
        ));
    }

}
