<?php

namespace App\Repository;

use App\Entity\CompetenceDomaine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CompetenceDomaine|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetenceDomaine|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetenceDomaine[]    findAll()
 * @method CompetenceDomaine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetenceDomaineRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CompetenceDomaine::class);
    }

//    /**
//     * @return CompetenceDomaine[] Returns an array of CompetenceDomaine objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CompetenceDomaine
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
