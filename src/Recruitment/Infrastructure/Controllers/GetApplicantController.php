<?php

declare(strict_types=1);

namespace Recruitment\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Recruitment\Application\UseCases\GetApplicantUseCase;
use Recruitment\Domain\ValueObjects\ApplicantId;
use Recruitment\Infrastructure\Repositories\DoctrineApplicantRepository;

final class GetApplicantController extends Controller
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): JsonResponse
    {
        $doctrineApplicantRepository = new DoctrineApplicantRepository($this->entityManager);
        $getApplicantUseCase = new GetApplicantUseCase($doctrineApplicantRepository);
        $applicantDTO = $getApplicantUseCase->__invoke(new ApplicantId($request['applicantId']));

        return response()->json($applicantDTO ? $applicantDTO->toArray() : []);
    }
}
