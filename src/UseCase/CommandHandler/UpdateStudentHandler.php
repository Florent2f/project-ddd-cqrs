<?php

namespace App\UseCase\CommandHandler;

use App\Repository\StudentRepository;
use App\Service\EmailVerifier;
use App\UseCase\Command\UpdateStudent;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

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


