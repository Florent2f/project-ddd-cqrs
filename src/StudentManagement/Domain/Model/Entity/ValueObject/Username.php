<?php

declare(strict_types=1);

namespace App\StudentManagement\Domain\Model\Entity\ValueObject;

use Webmozart\Assert\Assert;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
final readonly class Username implements \Stringable
{

    // private const int MIN = 3;
    // private const int MAX = 20;

    #[Column(type: "string")]
    public string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        Assert::lengthBetween($value, 3, 20);

        $this->value = $value;
    }

    #[\Override]
    public function __toString(): string
    {
        return $this->value;
    }

}

