<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LevelRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Resources\LevelResource;
use App\Services\Level\LevelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class LevelController extends Controller
{
    public function __construct(
        private readonly LevelService $levelService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/niveis",
     *     summary="Lista todos os níveis",
     *     description="Retorna uma lista paginada de níveis",
     *     tags={"Níveis"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Número da página",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Número de itens por página",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Campo que vai ser ordenado",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         description="Ordenação crescente (asc) ou descrescente (desc)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Filtra pela descrição do nível",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de níveis",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                       property="nivel",
     *                       type="string",
     *                       description="Nome do nível"
     *                   )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="meta",
     *                 type="object",
     *                 @OA\Property(
     *                     property="total",
     *                     type="integer",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="per_page",
     *                     type="integer",
     *                     example=2
     *                 ),
     *                 @OA\Property(
     *                     property="current_page",
     *                     type="integer",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="last_page",
     *                     type="integer",
     *                     example=1
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisição inválida"
     *     )
     * )
     */
    final public function index(PaginationRequest $request): AnonymousResourceCollection
    {
        return LevelResource::collection($this->levelService->paginate($request, ['id', 'level']));
    }

    /**
     * @OA\Post(
     *     path="/api/niveis",
     *     summary="Cria um novo nível",
     *     description="Cria um novo nível",
     *     tags={"Níveis"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *                  schema="Nivel",
     *                  type="object",
     *                  title="Nivel",
     *                  @OA\Property(
     *                      property="nivel",
     *                      type="string",
     *                      description="Nome do nível"
     *                  )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Nível criado",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisição inválida"
     *     )
     * )
     */
    final public function store(LevelRequest $request): JsonResponse
    {
        return LevelResource::make($this->levelService->create($request->validated()))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *     path="/api/niveis/{id}",
     *     summary="Atualiza um nível existente",
     *     description="Atualiza os dados de um nível existente",
     *     tags={"Níveis"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do nível",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *                  schema="Nivel",
     *                  type="object",
     *                  title="Nivel",
     *                  @OA\Property(
     *                      property="nivel",
     *                      type="string",
     *                      description="Nome do nível"
     *                  )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Nível atualizado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nível não encontrado"
     *     )
     * )
     */
    final public function update(LevelRequest $request, int $id): JsonResponse
    {
        try {
            return LevelResource::make($this->levelService->update($id, $request->validated()))
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);
        } catch (\Throwable $throwable) {
            return $this->responseError($throwable->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/niveis/{id}",
     *     summary="Exclui um nível",
     *     description="Exclui um nível existente",
     *     tags={"Níveis"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do nível",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Nível excluído com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Nível associado a desenvolvedores, não pode ser excluído"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Nível não encontrado"
     *     )
     * )
     */
    final public function destroy(int $id): JsonResponse
    {
        try {
            $this->levelService->delete($id);
            return $this->responseSuccess(
                message: 'Nível excluído com sucesso.',
                status: Response::HTTP_NO_CONTENT
            );
        } catch (\Throwable $throwable) {
            return $this->responseError($throwable->getMessage());
        }
    }
}
