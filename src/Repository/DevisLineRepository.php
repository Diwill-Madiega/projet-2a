<?php

namespace App\Repository;

use App\Entity\DevisLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DevisLine>
 */
class DevisLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DevisLine::class);
    }

    public function findByCustomer($customerId)
    {
        return $this->createQueryBuilder('dl')
            ->innerJoin('dl.devis', 'd')
            ->where('d.customer = :customer')
            ->setParameter('customer', $customerId)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return DevisLine[] Returns an array of DevisLine objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?DevisLine
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
