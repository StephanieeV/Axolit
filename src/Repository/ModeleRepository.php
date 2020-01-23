<?php

namespace App\Repository;

use App\Entity\Modele;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Modele|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modele|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modele[]    findAll()
 * @method Modele[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModeleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modele::class);
    }
    public function suggestModeleName($modeleName)
    {
        $query = $this
            ->createQueryBuilder('m')
            ->where("SOUNDEX(m.libelle) LIKE SOUNDEX(:search)")
            // To use SOUNDEX with another methods like MATCH_AGAINST
            // You can use the orWhere('SOUN....') clause instead of where
            // In case that you don't want to use parameter, you can set directly the string into the query
            //->where("SOUNDEX(a.table_field) LIKE SOUNDEX('%Title to search mispillid%')")
            ->setParameter('search',$modeleName)  
            ->getQuery();
            
        return $query->getResult();
        
    }





    // /**
    //  * @return Modele[] Returns an array of Modele objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Modele
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
