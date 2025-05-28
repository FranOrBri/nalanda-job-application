<?php

declare(strict_types=1);

namespace Recruitment\Domain\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;
use Ramsey\Uuid\Uuid;
use Recruitment\Domain\ValueObjects\ApplicantCv;
use Recruitment\Domain\ValueObjects\ApplicantEmail;
use Recruitment\Domain\ValueObjects\ApplicantExp;
use Recruitment\Domain\ValueObjects\ApplicantId;
use Recruitment\Domain\ValueObjects\ApplicantIsValid;
use Recruitment\Domain\ValueObjects\ApplicantName;

#[Entity]
#[Table(name: 'applicants')]
class Applicant
{
    #[Id]
    #[Column(type: 'string')]
    private string $id;

    #[Embedded(class: ApplicantName::class, columnPrefix: false)]
    private ApplicantName $name;

    #[Embedded(class: ApplicantEmail::class, columnPrefix: false)]
    private ApplicantEmail $email;

    #[Embedded(class: ApplicantExp::class, columnPrefix: false)]
    private ApplicantExp $exp;

    #[Embedded(class: ApplicantCv::class, columnPrefix: false)]
    private ApplicantCv $cv;

    #[Embedded(class: ApplicantIsValid::class, columnPrefix: false)]
    private ?ApplicantIsValid $isValid;

    #[ManyToOne(targetEntity: Recruiter::class)]
    #[JoinColumn(name: "recruiter_id", referencedColumnName: "id", nullable: true)]
    private ?Recruiter $recruiter;

    public function __construct(ApplicantName $name, ApplicantEmail $email, ApplicantExp $exp, ApplicantCv $cv)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->name = $name;
        $this->email = $email;
        $this->exp = $exp;
        $this->cv = $cv;
        $this->isValid = null;
        $this->recruiter = null;
    }

    public function getId(): ApplicantId
    {
        return new ApplicantId($this->id);
    }

    public function getName(): ApplicantName
    {
        return $this->name;
    }

    public function getEmail(): ApplicantEmail
    {
        return $this->email;
    }

    public function getExp(): ApplicantExp
    {
        return $this->exp;
    }

    public function getCv(): ApplicantCv
    {
        return $this->cv;
    }

    public function getIsValid(): ApplicantIsValid
    {
        return $this->isValid;
    }

    public function getRecruiter(): ?Recruiter
    {
        return $this->recruiter;
    }

    public function setRecruiter(?Recruiter $recruiter): void
    {
        $this->recruiter = $recruiter;
    }

    public function setIsValid(?ApplicantIsValid $isValid): void
    {
        $this->isValid = $isValid;
    }

    public function validate(): bool
    {
        return $this->exp->value() >= 2 && strlen(trim($this->cv->value())) > 0;
    }
}
