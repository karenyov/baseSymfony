<?php

namespace SysadminBundle\Controller;

use SysadminBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * 
     * @Route("/view", name="user_view")
     */
    public function viewAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('SysadminBundle:User')->listAll();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $users, $request->query->getInt('page', 1), 10
        );

        return $this->render('SysadminBundle:user:view.html.twig', array(
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
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }
        return $this->render('SysadminBundle:user:edit.html.twig', array(
                    'user' => $user,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/{id}/profile", name="user_profile")
     * @Method("GET")
     */
    public function profileAction(User $user) {
        return $this->render('SysadminBundle:profile:profile.html.twig', array(
                    'user' => $user,
        ));
    }

    /**
     * @Route("/{id}/profile_edit", name="user_profile_edit")
     * @Method({"GET", "POST"})
     */
    public function profileEditAction(Request $request, User $user) {
        $editForm = $this->createForm('SysadminBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_profile_edit', array('id' => $user->getId()));
        }
        return $this->render('SysadminBundle:profile:edit.html.twig', array(
                    'user' => $user,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/update_status", name="user_update_status")
     * @Method({"GET", "POST"})
     */
    public function updateStatusAction(Request $request) {
        $data = $request->get('users');

        $em = $this->getDoctrine()->getManager();
        $result = $em->getRepository('SysadminBundle:User')->updateStatus($data);

        $msg = [];
        if ($result) {
            $msg[] = ['success' => 'Informações atualizadas.'];
        } else {
            $msg[] = ['error' => 'Problemas para atualizar informações.'];
        }
        $json = new Response(json_encode($msg));
        
        return $json;
    }

}
