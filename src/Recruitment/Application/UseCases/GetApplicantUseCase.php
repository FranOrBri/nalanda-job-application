<?php

declare(strict_types=1);

namespace Recruitment\Application\UseCases;

use Recruitment\Application\DTOs\ApplicantDTO;
use Recruitment\Domain\Contracts\Repositories\ApplicantRepositoryInterface;
use Recruitment\Domain\ValueObjects\ApplicantId;

class GetApplicantUseCase
{
    private ApplicantRepositoryInterface $applicantRepository;

    public function __construct(ApplicantRepositoryInterface $applicantRepository)
    {
        $this->applicantRepository = $applicantRepository;
    }

    public function __invoke(ApplicantId $applicantId): ?ApplicantDTO
    {
        if (null === $applicant = $this->applicantRepository->findById($applicantId)) {
            return null;
        }

        return new ApplicantDTO(
            $applicant->getId()->value(),
            $applicant->getName()->value(),
            $applicant->getEmail()->value(),
            $applicant->getExp()->value(),
            $applicant->getCv()->value(),
            $applicant->getIsValid()?->value(),
            $applicant->getRecruiter()?->getId()->value(),
            $applicant->getRecruiter()?->getName()->value(),
        );
    }
}
