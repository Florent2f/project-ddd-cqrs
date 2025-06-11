<?php

declare(strict_types=1);

namespace App\UseCase\CommandHandler;

use App\Entity\Student;
use App\Service\EmailVerifier;
use App\UseCase\Command\AddStudent;
use App\Repository\StudentRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

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