<?php

declare(strict_types=1);

namespace Recruitment\Application\UseCases;

use Recruitment\Domain\Contracts\Repositories\RecruiterRepositoryInterface;
use Recruitment\Domain\Entities\Recruiter;
use Recruitment\Domain\ValueObjects\RecruiterName;

class CreateRecruiterUseCase
{
    private RecruiterRepositoryInterface $recruiterRepository;

    public function __construct(RecruiterRepositoryInterface $recruiterRepository)
    {
        $this->recruiterRepository = $recruiterRepository;
    }

    public function __invoke(RecruiterName $recruiterName): void
    {
        $applicant = new Recruiter($recruiterName);

        $this->recruiterRepository->save($applicant);
    }
}
