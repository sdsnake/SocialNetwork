<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;


class PostController extends AbstractController
{   

    /**
    * @Route("/reseaus/{id}/edit", name="edit_post", requirements={"id":"\d+"})
    */

    public function editPost(Post $post, Request $request, EntityManagerInterface $em) {

        
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(PostType::class, $post);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           
            $em->flush(); //

            return $this->redirectToRoute('comm_show', [ 'id' => $post->getId() ]);
        }
        
        return $this->render('reseaus/modify.html.twig', [
            'formPost' => $form->createView(),
            'editMode' => $post->getId()
        ]);

    }
    
    /**
     * @Route("/reseaus", name="reseaus")
     */
    public function index(PostRepository $repo)
    {   

        return $this->render('reseaus/index.html.twig', [
            'controller_name' => 'ReseausController',
            'posts' => $repo->findAll()
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

    public function create(Request $request, EntityManagerInterface $em) {

        
        $em = $this->getDoctrine()->getManager();

        $post = new Post();
        
        $form = $this->createForm(PostType::class, $post);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           

            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('comm_show', [ 'id' => $post->getId() ]);
        }
        
        return $this->render('reseaus/create.html.twig', [ /*créer une nouvelle vue modifer */
            'formPost' => $form->createView(),
            'editMode' => null
        ]);

    }


    /**
     * @Route("/reseaus/comm/{id}", name="comm_show")
     */

    public function show(Post $post){


        return $this->render('reseaus/show.html.twig', [
            'post' => $post,
            
        ]);

    }

   
}
