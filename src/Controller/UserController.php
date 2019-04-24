<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\User;
use App\Form\UserType;

/**
 * User controller.
 * @Route("/api", name="api_")
 */
class UserController extends FOSRestController
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
   * Create User.
   * @Rest\Post("/user")
   *
   * @return Response
   */
  public function postUserAction(Request $request)
  {
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $data = json_decode($request->getContent(), true);
    $form->submit($data);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();
      return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
    }
    return $this->handleView($this->view($form->getErrors()));
  }

}