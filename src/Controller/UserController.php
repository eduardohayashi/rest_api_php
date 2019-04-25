<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\User;
use App\Form\UserType;

/**
 * User controller.
 * @Route("/api", name="api_")
 */
class UserController extends AbstractFOSRestController
{

  /**
   * Lists all User.
   * @Rest\Get("/user")
   *
   * @return Response
   */
  public function getUserAction()
  {
    $repository = $this->getDoctrine()->getRepository(User::class);
    $user = $repository->findall();
    return $this->handleView($this->view($user));
  }

  /**
   * Lists all User.
   * @Rest\Get("/user/{name}")
   *
   * @return Response
   */
  public function getOneUserAction($name)
  {
    $repository = $this->getDoctrine()->getRepository(User::class); 
    $user = $repository->findByName($name);
    return $this->handleView($this->view($user));
  }



  /**
   * Create User.
   * @Rest\Put("/adduser")
   *
   * @return Response
   */
  public function putAction(Request $request)
  {
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $data = json_decode($request->getContent(), true);
    $form->submit($data);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();
      return $this->handleView($this->view(['status' => 'ok'],
        Response::HTTP_CREATED));
    }
    return $this->handleView($this->view($form->getErrors()));
  }


  /**
   * Update User.
   * @Rest\Put("/updateuser/{userId}")
   *
   * @return Response
   */
  public function updateUserAction(int $userId, Request $request)
  {
    $repository = $this->getDoctrine()->getRepository(User::class);
    $user = $repository->findOneById($userId);

    if (!$user) {
        throw $this->createNotFoundException(sprintf(
            'No user found with the ID given - "',
            $userId
        ));
    }

    $data = json_decode($request->getContent(), true);
    $form = $this->createForm(UserType::class, $user);
    $form->submit($data);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();
      return $this->handleView($this->view(['status' => 'ok'],
        Response::HTTP_CREATED));
    }

  }

  /**
   * Delete User.
   * @Rest\Delete("/deleteuser/{userId}")
   *
   * @return Response
   */
  public function deleteUserAction(int $userId)
  {
    $repository = $this->getDoctrine()->getRepository(User::class);
    $user = $repository->findOneById($userId);

    if (!$user) {
        throw $this->createNotFoundException(sprintf(
            'No user found with the ID given - "',
            $userId
        ));
    }

    $em = $this->getDoctrine()->getManager();
    $em->remove($user);
    $em->flush();

    return $this->handleView($this->view(['status' => 'ok'],
        Response::HTTP_CREATED));
  }
}
