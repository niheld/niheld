<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/post")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/list", name="app_post_index")
     */
    public function index(PostRepository $repoPost): Response
    {
        $user = $this->getUser();
        return $this->render('post/index.html.twig', [
            'posts' => $repoPost->findByAuthor($user),
        ]);
    }

    

    /**
     * @Route("/new", name="app_post_new", methods={"GET", "POST"})
     */
    public function new2(Request $request, PostRepository $repoPost): Response
    {
        // creates a task object and initializes some data for this example
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setAuthor($this->getUser());
            $repoPost->add($post, true);
            return $this->redirectToRoute('app_post_index');
        }

        return $this->render('post/new.html.twig', [
            'post' => $post,
            'form' =>$form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="app_post_show")
     */
    public function show(Post $post): Response{

        return $this->render('post/show.html.twig',[
                'article'=>$post,
        ]);
    }

    
    /**
     * @Route("/{id}/modifier", name="app_post_edit", methods={"GET", "POST"})
     */ 
    public function edit(Request $request, Post $post, PostRepository $repoPost): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repoPost->add($post, true);

            return $this->redirectToRoute('app_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('post/edit.html.twig', [
            'post' => $post,
            'form' => $form,
        ]);
    }
}
