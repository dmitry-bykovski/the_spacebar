<?php

namespace App\Repository;

use App\Entity\TestBD;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TestBD|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestBD|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestBD[]    findAll()
 * @method TestBD[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestBDRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestBD::class);
    }

    // /**
    //  * @return TestBD[] Returns an array of TestBD objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TestBD
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
