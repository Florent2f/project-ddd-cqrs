<?php

declare(strict_types=1);

namespace App\Form\Model;


use App\Entity\Student;
use App\Entity\ValueObject\Email;
use App\Entity\ValueObject\Address;
use App\Entity\ValueObject\Username;

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

