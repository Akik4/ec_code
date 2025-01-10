<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function getCategories() : array
    {
        return $this->createQueryBuilder('c')
        ->select('c.id, c.name')
        ->setMaxResults(100)
        ->getQuery()
        ->getResult();
    }

    public function countCategoriesByUser(int $userId) {

        $conn = $this->getEntityManager()->getConnection();

        $stmt = "SELECT category.id, count(*) as NUM FROM book_read INNER JOIN book ON book.id = book_read.book_id INNER JOIN category ON category.id =
book.category_id WHERE book_read.user_id = :user GROUP BY category.id;";
        
        $resultSet = $conn->executeQuery($stmt, ['user' => $userId]);

        return $resultSet->fetchAllAssociative();
    }

    //    /**
    //     * @return Category[] Returns an array of Category objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Category
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
