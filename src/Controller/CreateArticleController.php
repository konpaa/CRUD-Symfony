<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateArticleController
 * @package App\Controller
 */
class CreateArticleController extends AbstractController
{
    /**
     * @var ArticleRepository
     */
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
     * @throws ORMException
     * @throws OptimisticLockException
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
     * @throws ORMException
     * @throws OptimisticLockException
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

    /**
     * @Route("/article/{id}/deleted", name="deleted_article")
     * @param int $id
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deletedArticle(int $id): Response
    {
        $article = $this->articleRepository->findOneBy(['id' => $id]);
        $this->articleRepository->deleted($article);
        $this->addFlash('warning', 'DELETED article!!');
        return $this->redirectToRoute('show_article');
    }
}
