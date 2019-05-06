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
     * @param array $filter
     * @return array
     */
    public function getArticles(array $filter = []): array
    {
        $type = $filter['type'] ?? null;
        $parameters = [];
        $builder = $this->createQueryBuilder('a');
        $builder
            ->select(['a', 't'])
            ->leftJoin('a.type', 't');

        if ($type) {
            $builder->where('t.code = :type');
            $parameters['type'] = $type;
        }

        if ($parameters) {
            $builder->setParameters($parameters);
        }

        $builder->orderBy('a.priority', 'desc');
        return $builder
            ->getQuery()
            ->setResultCacheId(Article::class)
            ->getResult();
    }
}
