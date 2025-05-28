<?php

declare(strict_types=1);

namespace Recruitment\Application\UseCases;

use Recruitment\Domain\Contracts\Repositories\ApplicantRepositoryInterface;
use Recruitment\Domain\ValueObjects\ApplicantId;
use Recruitment\Domain\ValueObjects\ApplicantIsValid;

class ValidateApplicantUseCase
{
    private ApplicantRepositoryInterface $applicantRepository;

    public function __construct(ApplicantRepositoryInterface $applicantRepository,)
    {
        $this->applicantRepository = $applicantRepository;
    }

    public function __invoke(ApplicantId $applicantId): void
    {
        $applicant = $this->applicantRepository->findById($applicantId);

        $isValid = $applicant->validate();
        $applicant->setIsValid(new ApplicantIsValid($isValid));

        $this->applicantRepository->save($applicant);
    }
}
