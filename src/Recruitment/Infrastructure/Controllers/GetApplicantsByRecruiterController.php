<?php

declare(strict_types=1);

namespace Recruitment\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Recruitment\Application\UseCases\GetApplicantsByRecruiterUseCase;
use Recruitment\Domain\ValueObjects\RecruiterName;
use Recruitment\Infrastructure\Repositories\DoctrineApplicantRepository;

final class GetApplicantsByRecruiterController extends Controller
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): JsonResponse
    {
        $doctrineApplicantRepository = new DoctrineApplicantRepository($this->entityManager);
        $getApplicantsByRecruiterUseCase = new GetApplicantsByRecruiterUseCase($doctrineApplicantRepository);

        $recruiterName = ($request['recruiterName'] !== null) ? new RecruiterName($request['recruiterName']) : null;
        $applicantsList = $getApplicantsByRecruiterUseCase->__invoke($recruiterName, $request['orderByExp'] ?? null);

        return response()->json($applicantsList);
    }
}
