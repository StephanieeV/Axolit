<?php

namespace App\Repository;

use App\Entity\CompetencesUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CompetencesUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetencesUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetencesUser[]    findAll()
 * @method CompetencesUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetencesUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompetencesUser::class);
    }

    // /**
    //  * @return CompetencesUser[] Returns an array of CompetencesUser objects
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
    public function findOneBySomeField($value): ?CompetencesUser
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
