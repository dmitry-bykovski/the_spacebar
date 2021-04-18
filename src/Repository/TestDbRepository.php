<?php

namespace App\Repository;

use App\Entity\TestDb;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TestDb|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestDb|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestDb[]    findAll()
 * @method TestDb[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestDbRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestDb::class);
    }

    // /**
    //  * @return TestDb[] Returns an array of TestDb objects
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
    public function findOneBySomeField($value): ?TestDb
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
