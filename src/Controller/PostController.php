<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Post;
use App\Form\PostType;
use App\Entity\User;
use App\Service\FileUploader;

/**
 * Class PostController
 * @package App\Controller
 * @Route("/post")
 */
class PostController extends AbstractController
{
    /**
     *  @Route("/{id}/edit", name="post_edit", requirements={"id":"\d+"})
     *
     * @param Post $post
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function edit(Post $post, Request $request, FileUploader $fileUploader)
    {
        $this->denyAccessUnlessGranted('edit', $post);

        $form = $this->createForm(PostType::class, $post)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imgFile = $form['img']->getData();

            if ($imgFile) {
                $post->setImgFilename($fileUploader->upload($imgFile));
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        return $this->render('reseaus/modify.html.twig', [
            'formPost' => $form->createView(),
        ]);
    }

    /**
     * * @Route("/create", name="post_create")
     *
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function create(Request $request, FileUploader $fileUploader)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $post = new Post();

        $form = $this->createForm(PostType::class, $post)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imgFile = $form['img']->getData();

            if ($imgFile) {
                $post->setImgFilename($fileUploader->upload($imgFile));
            }

            $this->getDoctrine()->getManager()->persist($post);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }

        return $this->render('reseaus/create.html.twig', [
            'formPost' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/show/", name="post_show", requirements={"id":"\d+"})
     *
     * @param Post $post
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function show(Post $post, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $comment = new Comment();
        $comment->setPost($post);

        $form = $this->createForm(CommentType::class, $comment)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }


        return $this->render('reseaus/show.html.twig', [
            'post' => $post,
            'formComment' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="post_delete")
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function delete(Request $request, Post $post): Response
    {
        $this->denyAccessUnlessGranted('delete', $post);
        if ($this->isCsrfTokenValid('delete-item', $request->request->get('_token'))) {
            $this->getDoctrine()->getManager()->remove($post);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('reseaus');
    }

    /**
     * * @Route("/{id}/user", name="show_user")
     *
     * @param User $user
     * @return Response
     */
    public function showUser(User $user)
    {
        return $this->render('reseaus/user.html.twig', [
            'posts' => $user->getposts()
        ]);
    }

    /**
     * @Route("/like/{id}", name="post_like")
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function like(Post $post): JsonResponse
    {
        if ($post->getLoves()->contains($this->getUser())) {
            $post->getLoves()->removeElement($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            return $this->json(
                [
                    'code' => 200,
                    'likes' => count($post->getLoves()),
                    'loved' => false,

                ],
                200
            );
        }

        $post->getLoves()->add($this->getUser());
        $this->getDoctrine()->getManager()->flush();

        return $this->json(
            [
                'code' => 200,
                'likes' => count($post->getLoves()),
                'loved' => true,
            ],
            200
        );
    }
}
