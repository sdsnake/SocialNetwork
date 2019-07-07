<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;


class PostController extends AbstractController
{

    /**
     * @Route("/{id}/edit", name="edit_post", requirements={"id":"\d+"})
     */

    public function editPost(Post $post, Request $request)
    {

        $form = $this->createForm(PostType::class, $post)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        return $this->render('reseaus/modify.html.twig', [
            'formPost' => $form->createView(),
        ]);

    }


    /**
     * @Route("/new", name="reseaus_create")
     */

    public function create(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $post = new Post();
        /** @var \App\entity\User $user */
        $post->setUser($this->getUser());

        $form = $this->createForm(PostType::class, $post)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $this->getDoctrine()->getManager()->persist($post);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        return $this->render('reseaus/create.html.twig', [
            'formPost' => $form->createView(),
        ]);

    }


    /**
     * @Route("/post/{id}", name="post_show", requirements={"id":"\d+"})
     */

    public function show(Post $post, Request $request)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $comment = new Comment();
        /** @var @ \App\entity\User $user */
        $comment->setUser($this->getUser());
        $comment->setPost($post);

        $form = $this->createForm(CommentType::class, $comment)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }


        return $this->render('reseaus/show.html.twig', [
            'post' => $post,
            'formComment' => $form->createView(),

        ]);

    }

    /**
     * @Route("/{id}/del", name="post_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Post $post): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($this->isCsrfTokenValid('delete' . $post->getId(), $request->request->get('_token'))) {
            $this->getDoctrine()->getManager()->remove($post);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('reseaus');
    }

    /**
     * @Route("/{id}/user", name="show_user")
     */
    public function index(User $user)
    {
        return $this->render('reseaus/user.html.twig', [
            'posts' => $user->getposts()
        ]);
    }

}
