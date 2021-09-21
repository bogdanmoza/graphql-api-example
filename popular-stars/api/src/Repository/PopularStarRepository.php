<?php

namespace App\Repository;

use App\Entity\PopularStar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PopularStar|null find($id, $lockMode = null, $lockVersion = null)
 * @method PopularStar|null findOneBy(array $criteria, array $orderBy = null)
 * @method PopularStar[]    findAll()
 * @method PopularStar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PopularStarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PopularStar::class);
    }
    public function getPopularStars()
    {
        return $this->createQueryBuilder('p')
            ->setMaxResults(30)
            ->getQuery()
            ->getArrayResult();
    }

    // /**
    //  * @return PopularStar[] Returns an array of PopularStar objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PopularStar
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
