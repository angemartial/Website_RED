<?php

namespace App\Repository;

use App\Entity\Ad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ad::class);
    }

    public function findBestAds($limit){
        return $this->createQueryBuilder('a')
                    ->select('a as annonce, AVG(b.rating) as avgRatings')
                    ->join('a.comments','b')
                    ->groupBy('a')
                    ->orderBy('avgRatings', 'DESC')
                    ->setMaxResults($limit)
                    ->getQuery()
                    ->getResult();
    }



//    /**
//    * @return Query
//    */
//
//    public function findAllVisibleQurey($value) : Query
//    {
//        return $this->findAllVisible()
//                ->getQuery();
//    }


    // /**
    //  * @return Ad[] Returns an array of Ad objects
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
    public function findOneBySomeField($value): ?Ad
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
