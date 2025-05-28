<?php

declare(strict_types=1);

namespace Recruitment\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Recruitment\Application\UseCases\CreateApplicantUseCase;
use Recruitment\Domain\ValueObjects\ApplicantCv;
use Recruitment\Domain\ValueObjects\ApplicantEmail;
use Recruitment\Domain\ValueObjects\ApplicantExp;
use Recruitment\Domain\ValueObjects\ApplicantName;
use Recruitment\Infrastructure\Repositories\DoctrineApplicantRepository;

final class CreateApplicantController extends Controller
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): JsonResponse
    {
        $doctrineApplicantRepository = new DoctrineApplicantRepository($this->entityManager);
        $createApplicantUseCase = new CreateApplicantUseCase($doctrineApplicantRepository);
        $createApplicantUseCase->__invoke(
            new ApplicantName($request['name']),
            new ApplicantEmail($request['email']),
            new ApplicantExp($request['exp']),
            new ApplicantCv($request['cv'])
        );

        return response()->json();
    }
}
