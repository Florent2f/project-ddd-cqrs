<?php

declare(strict_types=1);

namespace App\StudentManagement\Application\UseCase\CommandHandler;

use App\StudentManagement\Domain\Model\Entity\Student;
use App\StudentManagement\Domain\Service\EmailVerifier;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use App\StudentManagement\Application\UseCase\Command\AddStudent;
use App\StudentManagement\Domain\Model\Repository\StudentRepository;

#[AsMessageHandler('command.bus')]
final class AddStudentHandler
{
    public function __construct(
        private StudentRepository $studentRepository,
        private EmailVerifier $emailVerifier
    ) {
    }

    public function __invoke(AddStudent $command): void
    {
        $this->emailVerifier->emailIsAlreadyUsed($command->email);
        $student = new Student(
            $command->email,
            $command->username,
            $command->address,
        );

        $this->studentRepository->add($student);
    }

}