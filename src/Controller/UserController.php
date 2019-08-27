<?php


namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     *
     * @param UserRepository $repo
     * @param Request $request
     * @return Response
     */
    public function index(UserRepository $repo, Request $request)
    {
        $users = $repo->findAll();

        return $this->render('reseaus/admin.html.twig', [
            'controller_name' => 'ReseausController',
            'users' => $users,

        ]);
    }

    /**
     * @Route("/{id}/switch/", name="suspend")
     *
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function suspend(User $user)
    {
        if ($user->getActive() == true) {
            $user->setActive(false);
        } else {
            $user->setActive(true);
        }

        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin');
    }
}
