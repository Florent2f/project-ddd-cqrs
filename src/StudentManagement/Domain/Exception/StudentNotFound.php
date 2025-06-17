<?php

declare(strict_types=1);

namespace App\StudentManagement\Domain\Exception;

final class StudentNotFound extends \DomainException
{
    public static function withId(int $studentId): self
    {
        return new self(sprintf('Student with id %d not found', $studentId));
    }
}