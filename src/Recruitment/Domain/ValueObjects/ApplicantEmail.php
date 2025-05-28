<?php

declare(strict_types=1);

namespace Recruitment\Domain\ValueObjects;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class ApplicantEmail
{
    #[Column(name: "email", type: 'string', unique: true)]
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }
}
