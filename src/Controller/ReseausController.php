<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReseausController extends AbstractController
{
    /**
     * @Route("/reseaus", name="reseaus")
     */
    public function index()
    {
        return $this->render('reseaus/index.html.twig', [
            'controller_name' => 'ReseausController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('reseaus/home.html.twig', [
            'title'=> "Bienvenu les zouzou !",
            'age' => 31
        ]);
    }
}
