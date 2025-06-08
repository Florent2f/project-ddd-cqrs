<?php

declare(strict_types=1);

namespace App\UseCase\QueryHandler;

use App\Entity\ValueObject\Address;
use App\Entity\ValueObject\Email;
use App\Entity\ValueObject\Username;
use App\ReadModel\StudentList;
use App\ReadModel\StudentProfile;
use App\Repository\StudentRepository;
use App\UseCase\Query\GetStudentList;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

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