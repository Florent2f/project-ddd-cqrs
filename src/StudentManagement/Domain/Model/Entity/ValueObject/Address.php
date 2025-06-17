<?php

declare(strict_types=1);

namespace App\StudentManagement\Domain\Model\Entity\ValueObject;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
final class Address
{
    public function __construct(
        #[Column(length: 255)]
        public ?string $city = null,
        #[Column(length: 255)]
        public ?string $country = null,
    ) {
        
    }

}

