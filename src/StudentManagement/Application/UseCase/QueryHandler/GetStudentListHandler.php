<?php

declare(strict_types=1);

namespace App\StudentManagement\Application\UseCase\QueryHandler;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use App\StudentManagement\Application\ReadModel\StudentList;
use App\StudentManagement\Application\ReadModel\StudentProfile;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Email;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Address;
use App\StudentManagement\Application\UseCase\Query\GetStudentList;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Username;
use App\StudentManagement\Domain\Model\Repository\StudentRepository;

#[AsMessageHandler('query.bus')]
final readonly class GetStudentListHandler
{

    public function __construct(
        private StudentRepository $studentRepository
    ) {
    }

    public function __invoke(GetStudentList $query)
    {
        return $this->mapStudentList($this->studentRepository->findAll());
    }

    private function mapStudentList(array $studentList): StudentList
    {
        $list = [];
        foreach ($studentList as $student) {
            $studentProfile = new StudentProfile(
                $student->id,
                new Email($student->email->value),
                new Username($student->username->value),
                new Address(
                    $student->address->city,
                    $student->address->country
                )
            );
            $list[] = $studentProfile;
        }

        return new StudentList($list);
    }
    
}