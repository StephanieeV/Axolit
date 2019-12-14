<?php

namespace App\Repository;

use App\Entity\PhotoProfil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PhotoProfil|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhotoProfil|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhotoProfil[]    findAll()
 * @method PhotoProfil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhotoProfilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhotoProfil::class);
    }

    // /**
    //  * @return PhotoProfil[] Returns an array of PhotoProfil objects
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
    public function findOneBySomeField($value): ?PhotoProfil
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
