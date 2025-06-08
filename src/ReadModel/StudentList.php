<?php

declare(strict_types=1);

namespace App\ReadModel;

use App\ReadModel\StudentProfile;
use Webmozart\Assert\Assert;

final class StudentList
{

    public function __construct(
        public array $studentList
    ) {
        Assert::allIsInstanceOf($studentList, StudentProfile::class);
    }
    
}