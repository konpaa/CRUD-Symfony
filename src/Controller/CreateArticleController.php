<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

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

    private AuthorizationCheckerInterface $authChecker;

    /**
     * CreateArticleController constructor.
     * @param ArticleRepository $articleRepository
     * @param AuthorizationCheckerInterface $authChecker
     */
    public function __construct(
        ArticleRepository $articleRepository,
        AuthorizationCheckerInterface $authChecker
    ) {
        $this->articleRepository = $articleRepository;
        $this->authChecker = $authChecker;
    }


    /**
     * @Route("/create/article", name="create_article")
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        if (false === $this->authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('warning', 'Please sing in!');
            return $this->redirectToRoute('about');
        }
        $article = new Article();

        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->articleRepository->save($article);
                $this->addFlash('success', 'Created new article!!!');
                return $this->redirectToRoute('show_article');
            } catch (Exception $exception) {
                echo $exception->getMessage();
            };
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
        if (false === $this->authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('warning', 'Please sing in!');
            return $this->redirectToRoute('article', ['id' => $id]);
        }
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
        if (false === $this->authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->addFlash('warning', 'Please sing in!');
            return $this->redirectToRoute('article', ['id' => $id]);
        }
        $article = $this->articleRepository->findOneBy(['id' => $id]);
        $this->articleRepository->deleted($article);
        $this->addFlash('warning', 'DELETED article!!');
        return $this->redirectToRoute('show_article');
    }
}
