<?php

declare(strict_types=1);

namespace Recruitment\Domain\ValueObjects;

class RecruiterId
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function value(): string
    {
        return $this->id;
    }
}
