<?php

declare(strict_types=1);

namespace Recruitment\Domain\Contracts\Repositories;

use Recruitment\Domain\Entities\Applicant;
use Recruitment\Domain\ValueObjects\ApplicantId;
use Recruitment\Domain\ValueObjects\RecruiterName;

interface ApplicantRepositoryInterface
{
    public function findById(ApplicantId $applicantId): ?Applicant;

    public function findAllByRecruiterName(?RecruiterName $recruiterName = null, ?string $orderByExp = 'ASC'): array;

    public function save(Applicant $applicant): void;
}
