<?php

declare(strict_types=1);

namespace Recruitment\Infrastructure\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Recruitment\Domain\Contracts\Repositories\RecruiterRepositoryInterface;
use Recruitment\Domain\Entities\Recruiter;
use Recruitment\Domain\ValueObjects\RecruiterId;

class DoctrineRecruiterRepository extends EntityRepository implements RecruiterRepositoryInterface
{
    private string $entityClass = Recruiter::class;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata($this->entityClass));
    }

    public function findById(RecruiterId $recruiterId): ?Recruiter
    {
        return $this->findOneBy(['id' => $recruiterId->value()]);
    }

    public function save(Recruiter $recruiter): void
    {
        $this->getEntityManager()->persist($recruiter);
        $this->getEntityManager()->flush();
    }
}
