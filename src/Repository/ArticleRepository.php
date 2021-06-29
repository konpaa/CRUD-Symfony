<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    /**
     * ArticleRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param Article $article
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Article $article)
    {
        $this->_em->persist($article);
        $this->_em->flush();
    }

    /**
     * @param Article $article
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deleted(Article $article)
    {
        $this->_em->remove($article);
        $this->_em->flush();
    }
}
