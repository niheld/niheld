<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        return $this->render('post/index.html.twig', [
            'posts' => $repoPost->findAll(),
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
}
