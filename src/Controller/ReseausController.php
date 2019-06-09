<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Post;
use App\Repository\PostRepository; 

class ReseausController extends Controller
{
    /**
     * @Route("/reseaus", name="reseaus")
     */
    public function index(PostRepository $repo)
    {   

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
    * @Route("/reseaus/new", name="reseaus_create")
    */

    public function create(Request $request, ObjectManager $manager) {

        $post = new Post();
        $form = $this->createFormBuilder($post)
                     ->add('title', TextType::class, [
                         'attr' => [
                            'placeholder' => "Titre",
                             ]
                     ])
                     ->add('content', TextareaType::class,  [
                        'attr' => [
                            'placeholder' => "contenu",
                            ]
                    ])
                     ->add('image', TextType::class, [
                         'attr' => [
                            'placeholder' => "image de l'article",

                         ]
                     ])
                     ->add('save', SubmitType::class, [
                         'label'=> "enregistrer"
                     ])
                     ->getForm();
        
        return $this->render('reseaus/create.html.twig', [
            'formPost' => $form->createView()
        ]);

    }

    /**
     * @Route("/reseaus/comm/{id}", name="comm_show")
     */

    public function show(Post $post /*$id*/){

       /* $repo = $this->getDoctrine()->getRepository(Post::class);
        
        $post = $repo->find($id);*/

        return $this->render('reseaus/show.html.twig', [
            'post' => $post
        ]);

    }

   
}
