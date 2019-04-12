<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ArticleRepository
 * @package App\Repository
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @return array
     */
    public function getArticles(): array
    {
        $builder = $this->createQueryBuilder('a');
        $builder->orderBy('a.priority', 'desc');
        return $builder->getQuery()->getResult();
    }
}
