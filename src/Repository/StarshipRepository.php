<?php

namespace App\Repository;

use App\Entity\Starship;
use App\Entity\StarshipStatusEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

/**
 * @extends ServiceEntityRepository<Starship>
 */
class StarshipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Starship::class);
    }

    /**
     * @return Starship[]
     */
    public function findIncompleteOrderedByDroidCount(): Pagerfanta
    {
        $query = $this->createQueryBuilder('s')
            ->addSelect('COUNT(starshipDroid) as HIDDEN droidCount')
            ->andWhere('s.status != :status')
            ->leftJoin('s.starshipDroids', 'starshipDroid')
            ->groupBy('s.id')
            ->orderBy('droidCount', 'ASC')
            ->setParameter('status', StarshipStatusEnum::COMPLETED)
            ->getQuery()
           ;

        return new Pagerfanta(new QueryAdapter($query));
    }

    public function findMyShip(): Starship
    {
        return $this->findAll()[0];
    }
}
