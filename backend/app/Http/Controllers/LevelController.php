<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LevelRequest;
use App\Http\Resources\LevelResource;
use App\Models\Level;
use App\Services\Level\LevelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class LevelController extends Controller
{
    public function __construct(
        private readonly LevelService $levelService
    ) {
    }

    final public function index(): AnonymousResourceCollection
    {
        return LevelResource::collection($this->levelService->paginate());
    }

    final public function store(LevelRequest $request): JsonResponse
    {
        return (new LevelResource($this->levelService->create($request->validated())))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    final public function update(LevelRequest $request, int $id): JsonResponse
    {
        try {
            return LevelResource::make($this->levelService->update($id, $request->validated()))
                ->response()->setStatusCode(Response::HTTP_ACCEPTED);
        } catch (\Throwable $throwable) {
            return $this->responseError(
                message: $throwable->getMessage(),
            );
        }
    }

    final public function destroy(int $id): JsonResponse
    {
        try {
            $this->levelService->delete($id);
            response()->noContent();
        } catch (\Throwable $throwable) {
           return $this->responseError(
               message: $throwable->getMessage(),
           );
        }
    }
}
