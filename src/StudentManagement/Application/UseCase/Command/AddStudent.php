<?php

declare(strict_types=1);

namespace App\StudentManagement\Application\UseCase\Command;

use App\StudentManagement\Domain\Model\Entity\ValueObject\Email;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Address;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Username;


final class AddStudent
{
    public function __construct(
        public Email $email,
        public Username $username,
        public Address $address
    ){
    }

    
}