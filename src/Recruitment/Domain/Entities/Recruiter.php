<?php

declare(strict_types=1);

namespace Recruitment\Domain\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\Uuid;
use Recruitment\Domain\ValueObjects\RecruiterId;
use Recruitment\Domain\ValueObjects\RecruiterName;

#[Entity]
#[Table(name: 'recruiters')]
class Recruiter
{
    #[Id]
    #[Column(type: 'string')]
    private string $id;

    #[Embedded(class: RecruiterName::class, columnPrefix: false)]
    private RecruiterName $name;

    public function __construct(RecruiterName $name)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->name = $name;
    }

    public function getId(): RecruiterId
    {
        return new RecruiterId($this->id);
    }

    public function getName(): RecruiterName
    {
        return $this->name;
    }
}
