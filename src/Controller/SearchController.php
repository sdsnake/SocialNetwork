<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class  SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search_post")
     */
    public function searchPost(Request $request)
    {
        return $this->render('search/result.html.twig');
    }
}