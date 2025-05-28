<?php

declare(strict_types=1);

namespace Recruitment\Domain\Contracts\Repositories;

use Recruitment\Domain\Entities\Recruiter;
use Recruitment\Domain\ValueObjects\RecruiterId;

interface RecruiterRepositoryInterface
{
    public function findById(RecruiterId $recruiterId): ?Recruiter;

    public function save(Recruiter $recruiter): void;
}
