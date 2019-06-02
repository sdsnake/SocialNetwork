<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

class ReseausController extends Controller
{
    /**
     * @Route("/reseaus", name="reseaus")
     */
    public function index()
    {   
        $repo = $this->getDoctrine()->getRepository(Post::class);

        $posts = $repo->findAll();

        return $this->render('reseaus/index.html.twig', [
            'controller_name' => 'ReseausController',
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('reseaus/home.html.twig', [
            'title'=> "Bienvenue!",
            'age' => 31
        ]);
    }

    /**
     * @Route("/reseaus/comm/12", name="comm_show")
     */

    public function show(){
        return $this->render('reseaus/show.html.twig');

    }
}
