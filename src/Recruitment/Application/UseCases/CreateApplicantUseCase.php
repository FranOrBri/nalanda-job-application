<?php

declare(strict_types=1);

namespace Recruitment\Application\UseCases;

use Recruitment\Domain\Contracts\Repositories\ApplicantRepositoryInterface;
use Recruitment\Domain\Entities\Applicant;
use Recruitment\Domain\ValueObjects\ApplicantCv;
use Recruitment\Domain\ValueObjects\ApplicantEmail;
use Recruitment\Domain\ValueObjects\ApplicantExp;
use Recruitment\Domain\ValueObjects\ApplicantName;

class CreateApplicantUseCase
{
    private ApplicantRepositoryInterface $applicantRepository;

    public function __construct(ApplicantRepositoryInterface $applicantRepository)
    {
        $this->applicantRepository = $applicantRepository;
    }

    public function __invoke(ApplicantName $name, ApplicantEmail $email, ApplicantExp $exp, ApplicantCv $cv): void
    {
        $applicant = new Applicant($name, $email, $exp, $cv);

        $this->applicantRepository->save($applicant);
    }
}
