<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function findNumberByFragName($fragName, $number = 5, $plateform = null)
    {

        $query_builder = $this->createQueryBuilder('g');

        $query_builder
        ->select('g.name', 'g.link_img')
        ->andWhere('g.name LIKE :fragName')
        ->setParameter('fragName', '%'.$fragName.'%');

        if ($plateform != null) {
            $query_builder
                ->innerJoin("g.plateforms", "P")
                ->andWhere("P.name = :plateform")
                ->setParameter("plateform", $plateform);
        }

        $query_builder
            ->orderBy('g.name', 'ASC')
            ->setMaxResults($number);
            
       
        return $query_builder
            ->getQuery()
            ->getResult();
    }

    public function findNumberOrderASC($number)
    {
        return $this->createQueryBuilder('g')
            ->select('g.name', 'g.link_img')
            ->orderBy('g.name', 'ASC')
            ->setMaxResults($number)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Game[] Returns an array of Game objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Game
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
