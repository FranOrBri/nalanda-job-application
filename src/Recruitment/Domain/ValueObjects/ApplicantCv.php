<?php

declare(strict_types=1);

namespace Recruitment\Domain\ValueObjects;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class ApplicantCv
{
    #[Column(name: "cv", type: 'string')]
    private string $cv;

    public function __construct(string $cv)
    {
        $this->cv = $cv;
    }

    public function value(): string
    {
        return $this->cv;
    }
}
