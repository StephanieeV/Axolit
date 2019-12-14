<?php

namespace App\Repository;

use App\Entity\CouleurAppareil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CouleurAppareil|null find($id, $lockMode = null, $lockVersion = null)
 * @method CouleurAppareil|null findOneBy(array $criteria, array $orderBy = null)
 * @method CouleurAppareil[]    findAll()
 * @method CouleurAppareil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CouleurAppareilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CouleurAppareil::class);
    }

    // /**
    //  * @return CouleurAppareil[] Returns an array of CouleurAppareil objects
    //  */
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
    public function findOneBySomeField($value): ?CouleurAppareil
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
