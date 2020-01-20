<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

       /**
    * Suggest Geoname
    */
    
    public function suggestUserName($userName)
    {
        $query = $this
            ->createQueryBuilder('a')
            ->where("SOUNDEX(a.pseudo) LIKE SOUNDEX(:search)")
            // To use SOUNDEX with another methods like MATCH_AGAINST
            // You can use the orWhere('SOUN....') clause instead of where
            // In case that you don't want to use parameter, you can set directly the string into the query
            //->where("SOUNDEX(a.table_field) LIKE SOUNDEX('%Title to search mispillid%')")
            ->setParameter('search',$userName)
            ->getQuery();
            
        return $query->getResult();
        
    }


    public function suggestPrenom($userName)
    {
        $query = $this
            ->createQueryBuilder('a')
            ->where("SOUNDEX(a.prenom) LIKE SOUNDEX(:search)")
            ->setParameter('search',$userName)  
            ->getQuery();
            
        return $query->getResult();
        
    }
    

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
