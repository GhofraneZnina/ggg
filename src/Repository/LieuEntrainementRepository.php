<?php

namespace App\Repository;

use App\Entity\LieuEntrainement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LieuEntrainement>
 *
 * @method LieuEntrainement|null find($id, $lockMode = null, $lockVersion = null)
 * @method LieuEntrainement|null findOneBy(array $criteria, array $orderBy = null)
 * @method LieuEntrainement[]    findAll()
 * @method LieuEntrainement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LieuEntrainementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LieuEntrainement::class);
    }

    public function save(LieuEntrainement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LieuEntrainement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LieuEntrainement[] Returns an array of LieuEntrainement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LieuEntrainement
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
