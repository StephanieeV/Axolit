<?php

namespace App\Repository;

use App\Entity\VersionOsAppareil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VersionOsAppareil|null find($id, $lockMode = null, $lockVersion = null)
 * @method VersionOsAppareil|null findOneBy(array $criteria, array $orderBy = null)
 * @method VersionOsAppareil[]    findAll()
 * @method VersionOsAppareil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VersionOsAppareilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VersionOsAppareil::class);
    }

    // /**
    //  * @return VersionOsAppareil[] Returns an array of VersionOsAppareil objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VersionOsAppareil
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
