<?php

declare(strict_types=1);

namespace App\StudentManagement\Domain\Service;

use App\StudentManagement\Domain\Exception\EmailAlreadyUsed;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Email;
use App\StudentManagement\Domain\Model\Repository\StudentRepository;


final readonly class EmailVerifier
{
    public function __construct(
        private StudentRepository $studentRepository
    ) {
    }

    public function emailIsAlreadyUsed(Email $email): void
    {
        $used = $this->studentRepository->findOneBy([
            'email.value' => $email->value,
        ]);

        if (!is_null($used)) {
            throw EmailAlreadyUsed::with($email->value);
        }
    }
}