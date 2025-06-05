<?php

namespace App\Entity;

use App\Entity\ValueObject\Address;
use App\Entity\ValueObject\Email;
use App\Entity\ValueObject\Username;
use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

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
