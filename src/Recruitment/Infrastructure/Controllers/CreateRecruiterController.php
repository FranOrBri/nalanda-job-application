<?php

declare(strict_types=1);

namespace Recruitment\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Recruitment\Application\UseCases\CreateRecruiterUseCase;
use Recruitment\Domain\ValueObjects\RecruiterName;
use Recruitment\Infrastructure\Repositories\DoctrineRecruiterRepository;

final class CreateRecruiterController extends Controller
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): JsonResponse
    {
        $doctrineRecruiterRepository = new DoctrineRecruiterRepository($this->entityManager);
        $createRecruiterUseCase = new CreateRecruiterUseCase($doctrineRecruiterRepository);
        $createRecruiterUseCase->__invoke(new RecruiterName($request['name']));

        return response()->json();
    }
}
