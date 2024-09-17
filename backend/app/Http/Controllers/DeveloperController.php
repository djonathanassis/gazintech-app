<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\DeveloperRequest;
use App\Http\Resources\DeveloperResource;
use App\Models\Developer;
use App\Services\Developer\DeveloperService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DeveloperController extends Controller
{
    public function __construct(
        private readonly DeveloperService $developerService
    ) {
    }

    final public function index(): AnonymousResourceCollection
    {
        return DeveloperResource::collection($this->developerService->paginate());
    }

    final public function store(DeveloperRequest $request): DeveloperResource
    {
        return DeveloperResource::make($this->developerService->create($request->validated()));
    }

    final public function update(DeveloperRequest $request, int $id): DeveloperResource
    {
        $developer = $this->developerService->update($id, $request->validated());
        return new DeveloperResource($developer);
    }

    final public function destroy(int $id): Response
    {
        $this->developerService->delete($id);
        return response()->noContent();
    }
}
