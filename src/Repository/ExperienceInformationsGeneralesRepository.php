<?php

namespace App\Repository;

use App\Entity\ExperienceInformationsGenerales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExperienceInformationsGenerales|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExperienceInformationsGenerales|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExperienceInformationsGenerales[]    findAll()
 * @method ExperienceInformationsGenerales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExperienceInformationsGeneralesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExperienceInformationsGenerales::class);
    }

//    /**
//     * @return ExperienceInformationsGenerales[] Returns an array of ExperienceInformationsGenerales objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExperienceInformationsGenerales
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
