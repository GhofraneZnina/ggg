<?php

namespace App\Repository;

use App\Entity\Saison;
use App\Entity\Planning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Saison>
 *
 * @method Saison|null find($id, $lockMode = null, $lockVersion = null)
 * @method Saison|null findOneBy(array $criteria, array $orderBy = null)
 * @method Saison[]    findAll()
 * @method Saison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Saison::class);
    }

    public function save(Saison $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Saison $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findWithPlanning($saisonId)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->select('s', 'p', 'l')
            ->leftJoin('s.planning', 'p')
            ->leftJoin('p.lieuEntrainement', 'l')
            ->where('s.id = :saisonId')
            ->setParameter('saisonId', $saisonId);
        
        return $qb->getQuery()->getOneOrNullResult();
    }

//    /**
//     * @return Saison[] Returns an array of Saison objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Saison
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
