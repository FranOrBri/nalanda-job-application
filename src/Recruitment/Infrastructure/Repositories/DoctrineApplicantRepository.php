<?php

declare(strict_types=1);

namespace Recruitment\Infrastructure\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Illuminate\Database\UniqueConstraintViolationException;
use Recruitment\Domain\Contracts\Repositories\ApplicantRepositoryInterface;
use Recruitment\Domain\Entities\Applicant;
use Recruitment\Domain\ValueObjects\ApplicantId;
use Recruitment\Domain\ValueObjects\RecruiterName;

class DoctrineApplicantRepository extends EntityRepository implements ApplicantRepositoryInterface
{
    private string $entityClass = Applicant::class;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata($this->entityClass));
    }

    public function findById(ApplicantId $applicantId): ?Applicant
    {
        return $this->findOneBy(['id' => $applicantId->value()]);
    }

    public function findAllByRecruiterName(?RecruiterName $recruiterName = null, ?string $orderByExp = 'ASC'): array
    {
        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('a', 'r')
            ->from($this->entityClass, 'a')
            ->leftJoin('a.recruiter', 'r');

        if (null !== $recruiterName && '' !== $recruiterName->value()) {
            $qb->andWhere('r.id IS NOT NULL')
                ->andWhere('LOWER(r.name.name) LIKE LOWER(:recruiterName)')
                ->setParameter('recruiterName', '%' . $recruiterName->value() . '%');
        }

        $qb->orderBy('a.exp.exp', $orderByExp);

        return $qb->getQuery()->getResult();
    }

    public function save(Applicant $applicant): void
    {
        try {
            $this->getEntityManager()->persist($applicant);
            $this->getEntityManager()->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw $e;
        }
    }
}
