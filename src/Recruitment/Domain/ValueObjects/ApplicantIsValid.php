<?php

declare(strict_types=1);

namespace Recruitment\Domain\ValueObjects;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class ApplicantIsValid
{
    #[Column(name: "is_valid", type: 'boolean', nullable: true)]
    private ?bool $isValid;

    public function __construct(?bool $isValid)
    {
        $this->isValid = $isValid;
    }

    public function value(): ?bool
    {
        return $this->isValid;
    }
}
