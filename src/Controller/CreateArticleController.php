<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateArticleController extends AbstractController
{
    private ArticleRepository $articleRepository;

    /**
     * CreateArticleController constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }


    /**
     * @Route("/create/article", name="create_article")
     */
    public function index(Request $request): Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->articleRepository->save($article);
            $this->addFlash('success', 'Created new article!!!');
            return $this->redirectToRoute('show_article');
        }

        return $this->render('create_article/index.html.twig', [
            'article_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/article/{id}/edit", name="edit_article")
     *
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function updateArticle(int $id, Request $request): Response
    {

        $article = $this->articleRepository->findOneBy(['id' => $id]);
        $form = $this->createForm(ArticleFormType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->articleRepository->save($article);
            $this->addFlash('success', 'Update article!!');
            return $this->redirectToRoute('show_article');
        }

        return $this->render('create_article/index.html.twig', [
            'article_form' => $form->createView(),
        ]);
    }
}
