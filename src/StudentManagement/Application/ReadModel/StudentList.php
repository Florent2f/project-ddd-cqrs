<?php

declare(strict_types=1);

namespace App\StudentManagement\Application\ReadModel;

use Webmozart\Assert\Assert;
use App\StudentManagement\Application\ReadModel\StudentProfile;

final class StudentList
{

    public function __construct(
        public array $studentList
    ) {
        Assert::allIsInstanceOf($studentList, StudentProfile::class);
    }
    
}