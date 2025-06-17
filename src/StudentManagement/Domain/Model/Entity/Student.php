<?php

namespace App\StudentManagement\Domain\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Email;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Address;
use App\StudentManagement\Domain\Model\Entity\ValueObject\Username;
use App\StudentManagement\Domain\Model\Repository\StudentRepository;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private(set) ?int $id = null;

    public function __construct(
        #[ORM\Embedded(class: Email::class, columnPrefix: null)]
        private(set) Email $email,
        #[ORM\Embedded(class: Username::class, columnPrefix: null)]
        private(set) Username $username,
        #[ORM\Embedded(class: Address::class, columnPrefix: false)]
        private(set) Address $address
    ) {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function updateProfile(Email $email, Username $username, Address $address): self {
        $this->email = $email;
        $this->username = $username;
        $this->address = $address;
        return $this;
    }
}
