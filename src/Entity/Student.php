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

    #[ORM\Embedded(class: Email::class, columnPrefix: null)]
    private(set) ?Email $email = null;

    #[ORM\Embedded(class: Username::class, columnPrefix: null)]
    private(set) ?Username $username = null;

    #[ORM\Embedded(class: Address::class, columnPrefix: false)]
    private(set) Address $address;

    public function __construct()
    {
        $this->address = new Address();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setEmail(string $email): static
    {
        $this->email = new Email($email);

        return $this;
    }

    public function setUsername(string $username): static
    {
        $this->username = new Username($username);

        return $this;
    }

    public function setAddress(Address $address): static
    {
        $this->address = $address;

        return $this;
    }
}
