<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/', requirements: ['_locale' => 'en|pl'])]
class PostController extends AbstractController
{
    #[Route('/{_locale}', methods: ['GET'], name: 'posts.index')]
    public function index(ManagerRegistry $doctrine,string $_locale = 'en'): Response
    {
        // $entityManager = $doctrine->getManager();
        // $user = $entityManager->getRepository(User::class)->find(1);
        // $entityManager->remove($user);
        // $entityManager->flush();
        // return new Response($user->getUser()->getEmail());
        // $entityManager = $doctrine->getManager();
        // $post = $entityManager->getRepository(Post::class)->find(1);
        // return new Response($post->getUser()->getEmail());
        // $user = $this->getUser();
        // return new Response($user->getPosts()[0]->getTitle());
        return $this->render('post/index.html.twig');
    }

    #[Route('/{_locale}/post/new', methods: ['GET', 'POST'], name: 'posts.new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $post = new Post();
        $post->setTitle('Write a blog post');
        $post->setContent('Post content');
        $post->setUser($this->getUser());
        $post->setCreatedAt(new \DateTimeImmutable('now'));
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            // $post = $form->getData();

            // ... perform some action, such as saving the task to the database
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('posts.index');
        }
        return $this->render('post/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{_locale}/post/{id}', methods: ['GET'], name: 'posts.show')]
    public function show($id): Response
    {
        return $this->render('post/show.html.twig');
    }

    #[Route('/{_locale}/post/{id}/edit', methods: ['GET', 'POST'], name: 'posts.edit')]
    public function edit(Request $request): Response
    {
        // return $this->redirectToRoute('posts.index');
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $post = $form->getData();
             // ... perform some action, such as saving the task to the database
             return $this->redirectToRoute('posts.index');
        }
        return $this->render('post/edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{_locale}/post/{id}/delete', methods: ['POST'], name: 'posts.delete')]
    public function delete($id): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return new Response('delete post from the database');
    }

    #[Route('/{_locale}/posts/user/{id}', methods: ['GET'], name: 'posts.user')]
    public function user($id): Response
    {
        // return new Response($id);
        return $this->render('post/index.html.twig');
    }

    #[Route('/{_locale}/toggleFollow/{user}', methods: ['GET'], name: 'toggleFollow')]
    public function toggleFollow($user): Response
    {
        // return new Response($user);
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return new Response('logic for toggling like/dislike functionality');
    }
}

