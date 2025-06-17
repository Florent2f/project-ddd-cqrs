<?php

namespace App\StudentManagement\Application\UseCase\CommandHandler;

use App\StudentManagement\Domain\Service\EmailVerifier;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use App\StudentManagement\Application\UseCase\Command\UpdateStudent;
use App\StudentManagement\Domain\Model\Repository\StudentRepository;

#[AsMessageHandler('command.bus')]
final class UpdateStudentHandler
{

    function __construct(
        private StudentRepository $studentRepository,
        private EmailVerifier $emailVerifier
    ) {
    }

    public function __invoke(UpdateStudent $command): void
    {
        $student = $this->studentRepository->getStudentById($command->idStudent);

        if($student->email->equals($command->email->value) === false){
            $this->emailVerifier->emailIsAlreadyUsed($command->email);
        }

        $student->updateProfile(
            $command->email,
            $command->username,
            $command->address
        );
        $this->studentRepository->add($student);
    }

}


