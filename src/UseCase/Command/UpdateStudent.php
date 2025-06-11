<?php

namespace App\UseCase\Command;

use App\Entity\ValueObject\Email;
use App\Entity\ValueObject\Address;
use App\Entity\ValueObject\Username;

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


