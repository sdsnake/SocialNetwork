<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * * @Route("/reseaus", name="reseaus")
     *
     * @param PostRepository $repo
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(PostRepository $repo, Request $request, PaginatorInterface $paginator)
    {
        $posts = $paginator->paginate(
            $repo->findByAll(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('reseaus/index.html.twig', [
            'controller_name' => 'ReseausController',
            'posts' => $posts,

        ]);
    }

    /**
     * * @Route("/", name="home")
     *
     * @return Response
     */
    public function home()
    {
        return $this->render('reseaus/home.html.twig', [
            'title' => "Bienvenue!"
        ]);
    }
}
