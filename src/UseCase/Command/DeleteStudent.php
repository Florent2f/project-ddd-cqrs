<?php

declare(strict_types=1);

namespace App\UseCase\Command;

final class DeleteStudent
{
    public function __construct(
        public int $studentId,
    ){
    }

}