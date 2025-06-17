<?php

declare(strict_types=1);

namespace App\StudentManagement\Domain\Exception;

final class EmailAlreadyUsed extends \DomainException
{
    public static function with(string $email): self
    {
        return new self(sprintf('Email %s is already used.', $email));
    }
}