<?php

declare(strict_types=1);

namespace Recruitment\Domain\ValueObjects;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class RecruiterName
{
    #[Column(name: "name", type: 'string')]
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function value(): string
    {
        return $this->name;
    }
}
