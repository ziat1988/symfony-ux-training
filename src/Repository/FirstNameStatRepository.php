<?php

namespace App\Repository;

use App\Entity\FirstNameStat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FirstNameStat>
 *
 * @method FirstNameStat|null find($id, $lockMode = null, $lockVersion = null)
 * @method FirstNameStat|null findOneBy(array $criteria, array $orderBy = null)
 * @method FirstNameStat[]    findAll()
 * @method FirstNameStat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FirstNameStatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FirstNameStat::class);
    }

    public function save(FirstNameStat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FirstNameStat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FirstNameStat[] Returns an array of FirstNameStat objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FirstNameStat
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
