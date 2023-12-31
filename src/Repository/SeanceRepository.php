<?php

namespace App\Repository;

use App\Entity\Seance;
use App\Entity\Nageur;
use App\Entity\Saison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Seance>
 *
 * @method Seance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seance[]    findAll()
 * @method Seance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seance::class);
    }

    public function save(Seance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Seance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function getSeance( Nageur $nageur ){

         return $this->createQueryBuilder('s')
        
        ->join('s.groupe', 'g')
        ->join('g.nageur', 'e')
        ->join('s.planning', 'p')
        ->where('e.id = :nageurId')
        ->andWhere('s.planning IS NOT NULL')
        ->andWhere('p.status = 1')
        ->andWhere('g.id = :groupeId')
        ->setParameter('nageurId', $nageur->getId())
        ->setParameter('groupeId', $nageur->getGroupe()->getId())
        ->getQuery()
        ->getResult();
    }
    // public function findByCurrent($current)
    // {
    //     $qb = $this->createQueryBuilder('c')
    //         ->where('c.current = :current')
    //         ->setParameter('current', $current);

    //     return $qb->getQuery()->getResult();
    // }
  
    

//    /**
//     * @return Seance[] Returns an array of Seance objects
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

//    public function findOneBySomeField($value): ?Seance
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
