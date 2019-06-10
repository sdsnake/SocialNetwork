<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;


class ReseausController extends AbstractController
{   

    /**
    * @Route("/reseaus/{id}/edit", name="edit_post", requirements={"id":"\d+"})
    */

    public function editPost(Post $post, Request $request, ObjectManager $manager) {

        


        $form = $this->createForm(PostType::class, $post);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           

            $manager->persist($post);
            $manager->flush();

            return $this->redirectToRoute('comm_show', [ 'id' => $post->getId() ]);
        }
        
        return $this->render('reseaus/create.html.twig', [
            'formPost' => $form->createView(),
            'editMode' => $post->getId()
        ]);

    }
    
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

    public function create(Post $post = null, Request $request, ObjectManager $manager) {

        

            $post = new Post();
            if(!$post->getId()){
            $post->setCreatedAt(new \DateTime());
            }

        

        $form = $this->createForm(PostType::class, $post);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
           

            $manager->persist($post);
            $manager->flush();

            return $this->redirectToRoute('comm_show', [ 'id' => $post->getId() ]);
        }
        
        return $this->render('reseaus/create.html.twig', [
            'formPost' => $form->createView(),
            'editMode' => null
        ]);

    }


    /**
     * @Route("/reseaus/comm/{id}", name="comm_show")
     */

    public function show(Post $post /*$id*/){

       /* $repo = $this->getDoctrine()->getRepository(Post::class);
        
        $post = $repo->find($id);*/

        return $this->render('reseaus/show.html.twig', [
            'post' => $post,
            //'comments' => $comments
        ]);

    }

   
}
