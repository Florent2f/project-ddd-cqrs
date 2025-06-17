<?php

declare(strict_types=1);

namespace App\StudentManagement\Presentation\Web\Form\Model;

use App\StudentManagement\Domain\Model\Entity\Student;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Email;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Address;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Username;

final class StudentModel
{

    public function __construct(
        public ?Email $email = null,
        public ?Username $username = null,
        public Address $address = new Address()
    ) {
        
    }

    public static function createFromEntity(Student $student): self
    {
        return new self(
            $student->email,
            $student->username,
            $student->address
        );
    }

}

