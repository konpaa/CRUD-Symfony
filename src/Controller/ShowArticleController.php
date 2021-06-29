<?php

namespace App\Controller;

use App\Dto\Transformer\ArticleDtoTransformer;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowArticleController extends AbstractController
{
    private ArticleRepository $articleRepository;
    private ArticleDtoTransformer $articleDtoTransformer;

    /**
     * ShowArticleController constructor.
     * @param ArticleRepository $articleRepository
     * @param ArticleDtoTransformer $articleDtoTransformer
     */
    public function __construct(ArticleRepository $articleRepository, ArticleDtoTransformer $articleDtoTransformer)
    {
        $this->articleRepository = $articleRepository;
        $this->articleDtoTransformer = $articleDtoTransformer;
    }

    /**
     * @Route("/show/article", name="show_article")
     */
    public function show(): Response
    {
        $article = $this->articleRepository->findAll();
        return $this->render('show_article/index.html.twig', [
            'articles' => $this->articleDtoTransformer->transformFromObjects($article),
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     * @param int $id
     * @return Response
     */
    public function showOneArticle(int $id): Response
    {
        $article = $this->articleRepository->findOneBy(['id' => $id]);
        return $this->render('show_article/index.html.twig', [
            'articles' => $this->articleDtoTransformer->transformFromObject($article)
        ]);
    }
}
