<?php

declare(strict_types=1);

namespace Recruitment\Application\DTOs;

class ApplicantDTO
{
    public string $id;
    public string $name;
    public string $email;
    public int $exp;
    public string $cv;
    public ?bool $isValid;
    public ?string $recruiterId;
    public ?string $recruiterName;

    public function __construct(string $id, string $name, string $email, int $exp, string $cv, ?bool $isValid, ?string $recruiterId, ?string $recruiterName)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->exp = $exp;
        $this->cv = $cv;
        $this->isValid = $isValid;
        $this->recruiterId = $recruiterId;
        $this->recruiterName = $recruiterName;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'exp' => $this->exp,
            'cv' => $this->cv,
            'isValid' => $this->isValid,
            'recruiterId' => $this->recruiterId,
            'recruiterName' => $this->recruiterName
        ];
    }
}
