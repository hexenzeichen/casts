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
            ->where('s.status != :status')
            ->orderBy('COUNT(droid)', 'ASC')
            ->leftJoin('s.droids', 'droid')
            ->groupBy('s.id')
            ->setParameter('status', StarshipStatusEnum::COMPLETED)
            ->orderBy('s.arrivedAt', 'DESC')
            ->getQuery()
            ;

        return new Pagerfanta(new QueryAdapter($query));
    }

    public function findMyShip(): Starship
    {
        return $this->findAll()[0];
    }
}
