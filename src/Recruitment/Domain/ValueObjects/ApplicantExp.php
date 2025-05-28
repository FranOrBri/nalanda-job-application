<?php

declare(strict_types=1);

namespace Recruitment\Domain\ValueObjects;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class ApplicantExp
{
    #[Column(name: "exp", type: 'integer')]
    private int $exp;

    public function __construct(int $exp)
    {
        $this->exp = $exp;
    }

    public function value(): int
    {
        return $this->exp;
    }
}
