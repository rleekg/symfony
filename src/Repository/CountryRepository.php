<?php

namespace App\Repository;

use App\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CountryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

    public function findByTxNumber(string $taxNumber): ?Country
    {
        $qb = $this->createQueryBuilder('c');

        $qb->where('c.code = :code')
        ->setParameter('code', mb_substr($taxNumber, 0, 2));

        return $qb->getQuery()->getSingleResult();
    }
}
