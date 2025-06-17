<?php

declare(strict_types=1);

namespace App\StudentManagement\Application\ReadModel;

use App\StudentManagement\Domain\Model\Entity\ValueObject\Email;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Address;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Username;

final class StudentProfile
{

    public function __construct(
        public int $id,
        public Email $email,
        public Username $username,
        public Address $address,
        public $age = 42, //Ex : Age si on à la date de naissance : Abstraction sur l'entité (Possibilité d'adapter le model de lecture au besoin)
    ) {
    }

}