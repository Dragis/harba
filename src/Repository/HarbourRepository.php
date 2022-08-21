<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Harbour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Harbour|null find($id, $lockMode = null, $lockVersion = null)
 * @method Harbour|null findOneBy(array $criteria, array $orderBy = null)
 * @method Harbour[]    findAll()
 * @method Harbour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HarbourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Harbour::class);
    }
}
