<?php


namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class UsersManagerController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
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
     * @Route("/switch/{id}", name="restraint")
     */
    public function restraint(User $user)
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
