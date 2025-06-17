<?php

declare(strict_types=1);

namespace App\StudentManagement\Application\UseCase\CommandHandler;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use App\StudentManagement\Application\UseCase\Command\DeleteStudent;
use App\StudentManagement\Domain\Model\Repository\StudentRepository;

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