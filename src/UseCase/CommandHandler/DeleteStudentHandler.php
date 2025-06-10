<?php

declare(strict_types=1);

namespace App\UseCase\CommandHandler;

use App\Repository\StudentRepository;
use App\UseCase\Command\DeleteStudent;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler('command.bus')]
final class DeleteStudentHandler
{
    public function __construct(
        private StudentRepository $studentRepository
    ) {
    }

    public function __invoke(DeleteStudent $command): void
    {
        $student = $this->studentRepository->getStudentById($command->studentId);
        $this->studentRepository->remove($student);
    }

}