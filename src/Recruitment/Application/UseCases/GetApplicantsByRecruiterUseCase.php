<?php

declare(strict_types=1);

namespace Recruitment\Application\UseCases;

use Recruitment\Application\DTOs\ApplicantDTO;
use Recruitment\Domain\Contracts\Repositories\ApplicantRepositoryInterface;
use Recruitment\Domain\Entities\Applicant;
use Recruitment\Domain\ValueObjects\RecruiterName;

class GetApplicantsByRecruiterUseCase
{
    private ApplicantRepositoryInterface $applicantRepository;

    public function __construct(ApplicantRepositoryInterface $applicantRepository)
    {
        $this->applicantRepository = $applicantRepository;
    }

    public function __invoke(?RecruiterName $recruiterName, ?string $orderByExp): array
    {
        $applicants = $this->applicantRepository->findAllByRecruiterName($recruiterName, $orderByExp);

        $applicantList = [];
        /** @var Applicant $applicant */
        foreach ($applicants as $applicant) {
            $applicantDTO = new ApplicantDTO (
                $applicant->getId()->value(),
                $applicant->getName()->value(),
                $applicant->getEmail()->value(),
                $applicant->getExp()->value(),
                $applicant->getCv()->value(),
                $applicant->getIsValid()?->value(),
                $applicant->getRecruiter()?->getId()->value(),
                $applicant->getRecruiter()?->getName()->value(),
            );

            $applicantList[] = $applicantDTO->toArray();
        }

        return $applicantList;
    }
}
