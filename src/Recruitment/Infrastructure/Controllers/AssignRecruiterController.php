<?php

declare(strict_types=1);

namespace Recruitment\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Recruitment\Application\UseCases\AssignRecruiterUseCase;
use Recruitment\Domain\ValueObjects\ApplicantId;
use Recruitment\Domain\ValueObjects\RecruiterId;
use Recruitment\Infrastructure\Repositories\DoctrineApplicantRepository;
use Recruitment\Infrastructure\Repositories\DoctrineRecruiterRepository;

final class AssignRecruiterController extends Controller
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): JsonResponse
    {
        $doctrineApplicantRepository = new DoctrineApplicantRepository($this->entityManager);
        $doctrineRecruiterRepository = new DoctrineRecruiterRepository($this->entityManager);
        $createApplicantUseCase = new AssignRecruiterUseCase($doctrineApplicantRepository, $doctrineRecruiterRepository);

        $createApplicantUseCase->__invoke(new ApplicantId($request['applicantId']), new RecruiterId($request['recruiterId']));

        return response()->json();
    }
}
