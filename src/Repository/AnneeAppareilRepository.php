<?php

namespace App\Repository;

use App\Entity\AnneeAppareil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AnneeAppareil|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnneeAppareil|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnneeAppareil[]    findAll()
 * @method AnneeAppareil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnneeAppareilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnneeAppareil::class);
    }

    // /**
    //  * @return AnneeAppareil[] Returns an array of AnneeAppareil objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnneeAppareil
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
