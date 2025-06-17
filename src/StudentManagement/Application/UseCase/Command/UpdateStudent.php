<?php

namespace App\StudentManagement\Application\UseCase\Command;

use App\StudentManagement\Domain\Model\Entity\ValueObject\Email;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Address;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Username;


final class UpdateStudent
{
    public function __construct(
        public int $idStudent,
        public Email $email,
        public Username $username,
        public Address $address
    ) {
    }

}


