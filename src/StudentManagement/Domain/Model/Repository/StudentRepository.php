<?php

namespace App\StudentManagement\Domain\Model\Repository;

use Doctrine\Persistence\ManagerRegistry;
use App\StudentManagement\Domain\Model\Entity\Student;
use App\StudentManagement\Domain\Exception\StudentNotFound;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Student>
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }
    
    public function add(Student $student): void
    {
        $this->getEntityManager()->persist($student);
        $this->getEntityManager()->flush();
    }

    public function remove(Student $student): void
    {
        $this->getEntityManager()->remove($student);
        $this->getEntityManager()->flush();
    }

    public function getStudentById(int $studentId): Student
    {
        $student = $this->find($studentId);

        if(is_null($student)){
            throw StudentNotFound::withId($studentId);
        }

        return $student;
    }

    //    /**
    //     * @return Student[] Returns an array of Student objects
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

    //    public function findOneBySomeField($value): ?Student
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
