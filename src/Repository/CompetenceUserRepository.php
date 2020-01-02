<?php

namespace App\Repository;

use App\Entity\CompetenceUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CompetenceUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetenceUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetenceUser[]    findAll()
 * @method CompetenceUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetenceUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompetenceUser::class);
    }

    // /**
    //  * @return CompetenceUser[] Returns an array of CompetenceUser objects
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
    public function findOneBySomeField($value): ?CompetenceUser
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
