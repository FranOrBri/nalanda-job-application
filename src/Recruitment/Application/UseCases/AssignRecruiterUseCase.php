<?php

declare(strict_types=1);

namespace Recruitment\Application\UseCases;

use Recruitment\Domain\Contracts\Repositories\ApplicantRepositoryInterface;
use Recruitment\Domain\Contracts\Repositories\RecruiterRepositoryInterface;
use Recruitment\Domain\ValueObjects\ApplicantId;
use Recruitment\Domain\ValueObjects\RecruiterId;

class AssignRecruiterUseCase
{
    private ApplicantRepositoryInterface $applicantRepository;
    private RecruiterRepositoryInterface $recruiterRepository;

    public function __construct(ApplicantRepositoryInterface $applicantRepository, RecruiterRepositoryInterface $recruiterRepository)
    {
        $this->applicantRepository = $applicantRepository;
        $this->recruiterRepository = $recruiterRepository;
    }

    public function __invoke(ApplicantId $applicantId, RecruiterId $recruiterId): void
    {
        $applicant = $this->applicantRepository->findById($applicantId);
        $recruiter = $this->recruiterRepository->findById($recruiterId);

        $applicant->setRecruiter($recruiter);

        $this->applicantRepository->save($applicant);
    }
}
