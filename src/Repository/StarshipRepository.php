<?php

namespace App\Repository;

use App\Entity\Starship;
use App\Entity\StarshipStatusEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
    public function findIncomplete(): array
    {
        return $this->createQueryBuilder('s')
            ->where('s.status != :status')
            ->orderBy('s.arrivedAt', 'DESC')
            ->setParameter('status', StarshipStatusEnum::COMPLETED)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findMyShip(): Starship
    {
        return $this->findAll()[0];
    }
}
