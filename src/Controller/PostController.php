<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;

class PostController extends AbstractController
{
    #[Route('/{_locale?}', methods: ['GET'], name: 'posts.index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // $post = $doctrine->getRepository(Post::class)->find(2); // findAll()
        // // $doctrine->getManager()->remove($post);
        // // $doctrine->getManager()->flush();
        // $post->setTitle('New blog title!');
        // $doctrine->getManager()->flush();
        // return new Response('Check out this great product: ' . $post->getTitle());
        return $this->render('post/index.html.twig');
    }

    #[Route('/post/new', methods: ['GET', 'POST'], name: 'posts.new')]
    public function new(ManagerRegistry $doctrine): Response
    {
        // $entityManager = $doctrine->getManager();
        // $post = new Post();
        // $post->setTitle('Title');
        // $post->setContent('Post content');
        // $post->setCreatedAt(new \DateTimeImmutable());
        // //tell Doctrine you want to (eventually) save the Product (no queries yet)
        // $entityManager->persist($post);
        // //actually executes the queries (i.e. the INSERT query)
        // $entityManager->flush();
        // return new Response('Saved new post with id '.$post->getId());
        return $this->render('post/new.html.twig');
    }

    #[Route('/post/{id}/{_locale?}', methods: ['GET'], name: 'posts.show')]
    public function show($id): Response
    {
        return $this->render('post/show.html.twig');
    }

    #[Route('/post/{id}/edit', methods: ['GET', 'POST'], name: 'posts.edit')]
    public function edit($id): Response
    {
        // return $this->redirectToRoute('posts.index');
        return $this->render('post/edit.html.twig');
    }

    #[Route('/post/{id}/delete', methods: ['POST'], name: 'posts.delete')]
    public function delete($id): Response
    {
        return new Response('delete post from the database');
    }

    #[Route('/posts/user/{id}', methods: ['GET'], name: 'posts.user')]
    public function user($id): Response
    {
        // return new Response($id);
        return $this->render('post/index.html.twig');
    }

    #[Route('/toggleFollow/{user}', methods: ['GET'], name: 'toggleFollow')]
    public function toggleFollow($user): Response
    {
        // return new Response($user);
        return new Response('logic for toggling like/dislike functionality');
    }
}

