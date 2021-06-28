<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowArticleController extends AbstractController
{
    private ArticleRepository $articleRepository;

    /**
     * ShowArticleController constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Route("/show/article", name="show_article")
     */
    public function show(): Response
    {
        $article = $this->articleRepository->findAll();
        return $this->render('show_article/index.html.twig', [
            'articles' => $article,
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     * @param int $id
     * @return Response
     */
    public function showOneArticle(int $id): Response
    {

        return $this->render('show_article/index.html.twig', [
            'articles' => $this->articleRepository->findOneBy(['id' => $id])
        ]);
    }
}
