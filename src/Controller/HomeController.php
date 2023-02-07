<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="index_home")
     */
    public function index(PostRepository $repoPost): Response
    {
        $posts = $repoPost->findAll();
        
        return $this->render('home/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
