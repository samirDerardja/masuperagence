<?php

namespace App\Repository;

use App\Entity\MoreOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MoreOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method MoreOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method MoreOption[]    findAll()
 * @method MoreOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MoreOptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MoreOption::class);
    }

    // /**
    //  * @return MoreOption[] Returns an array of MoreOption objects
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
    public function findOneBySomeField($value): ?MoreOption
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
