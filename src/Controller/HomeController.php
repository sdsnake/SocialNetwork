<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

class HomeController extends AbstractController
{


    /**
     * @Route("/reseaus", name="reseaus")
     */
    public function index(PostRepository $repo, Request $request, PaginatorInterface $paginator)
    {

        $posts = $paginator->paginate($repo->findAll(),
            $request->query->getInt('page', 1),
            6
        );



        return $this->render('reseaus/index.html.twig', [
            'controller_name' => 'ReseausController',
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('reseaus/home.html.twig', [
            'title' => "Bienvenue!"
        ]);
    }


}
