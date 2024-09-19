<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\DeveloperDto;
use App\Http\Requests\DeveloperRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Resources\DeveloperResource;
use App\Services\Developer\DeveloperService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

class DeveloperController extends Controller
{
    public function __construct(
        private readonly DeveloperService $developerService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/desenvolvedores",
     *     summary="Lista todos os desenvolvedores",
     *     description="Retorna uma lista paginada de desenvolvedores",
     *     tags={"Desenvolvedores"},
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
     *         description="Filtra pelo nome do desenvolvedor",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de desenvolvedores",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                          property="id",
     *                          type="integer",
     *                          description="ID do desenvolvedor"
     *                     ),
     *                     @OA\Property(
     *                         property="nome",
     *                         type="string",
     *                         description="Nome do desenvolvedor"
     *                     ),
     *                     @OA\Property(
     *                         property="hobby",
     *                         type="string",
     *                         description="Hobby do desenvolvedor"
     *                     ),
     *                     @OA\Property(
     *                         property="sexo",
     *                         type="string",
     *                         description="Sexo do desenvolvedor"
     *                     ),
     *                     @OA\Property(
     *                         property="data_nascimento",
     *                         type="string",
     *                         format="date",
     *                         description="Data de nascimento do desenvolvedor"
     *                     ),
     *                     @OA\Property(
     *                         property="nivel_id",
     *                         type="integer",
     *                         description="ID do nível do desenvolvedor"
     *                     ),
     *                     @OA\Property(
     *                         property="idade",
     *                         type="integer",
     *                         description="Idade do desenvolvedor",
     *                         readOnly=true
     *                     )
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
        return DeveloperResource::collection(
            $this->developerService->paginate($request, ['id', 'nome', 'hobby', 'sexo', 'nivel_id'])
        );
    }

    /**
     * @OA\Post(
     *     path="/api/desenvolvedores",
     *     summary="Cria um novo desenvolvedor",
     *     description="Cria um novo desenvolvedor",
     *     tags={"Desenvolvedores"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *                  schema="Desenvolvedor",
     *                  type="object",
     *                  title="Desenvolvedor",
     *                  required={"nome", "hobby", "nivel_id", "sexo", "data_nascimento"},
     *                  @OA\Property(
     *                      property="id",
     *                      type="integer",
     *                      description="ID do desenvolvedor"
     *                  ),
     *                  @OA\Property(
     *                      property="nome",
     *                      type="string",
     *                      description="Nome do desenvolvedor"
     *                  ),
     *                  @OA\Property(
     *                      property="hobby",
     *                      type="string",
     *                      description="Hobby do desenvolvedor"
     *                  ),
     *                  @OA\Property(
     *                      property="sexo",
     *                      type="string",
     *                      description="Sexo do desenvolvedor"
     *                  ),
     *                  @OA\Property(
     *                      property="data_nascimento",
     *                      type="string",
     *                      format="date",
     *                      description="Data de nascimento do desenvolvedor"
     *                  ),
     *                  @OA\Property(
     *                      property="nivel_id",
     *                      type="integer",
     *                      description="ID do nível do desenvolvedor"
     *                  ),
     *                  @OA\Property(
     *                      property="idade",
     *                      type="integer",
     *                      description="Idade do desenvolvedor",
     *                      readOnly=true
     *                  )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Desenvolvedor criado",
     *         @OA\JsonContent(
     *                  schema="Desenvolvedor",
     *                  type="object",
     *                  title="Desenvolvedor",
     *                  required={"nome", "hobby", "nivel_id", "sexo", "data_nascimento"},
     *                  @OA\Property(
     *                       property="id",
     *                       type="integer",
     *                       description="ID do desenvolvedor"
     *                   ),
     *                   @OA\Property(
     *                       property="nome",
     *                       type="string",
     *                       description="Nome do desenvolvedor"
     *                   ),
     *                   @OA\Property(
     *                       property="hobby",
     *                       type="string",
     *                       description="Hobby do desenvolvedor"
     *                   ),
     *                   @OA\Property(
     *                       property="sexo",
     *                       type="string",
     *                       description="Sexo do desenvolvedor"
     *                   ),
     *                   @OA\Property(
     *                       property="data_nascimento",
     *                       type="string",
     *                       format="date",
     *                       description="Data de nascimento do desenvolvedor"
     *                   ),
     *                   @OA\Property(
     *                       property="nivel_id",
     *                       type="integer",
     *                       description="ID do nível do desenvolvedor"
     *                   ),
     *                   @OA\Property(
     *                       property="idade",
     *                       type="integer",
     *                       description="Idade do desenvolvedor",
     *                       readOnly=true
     *                   )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisição inválida"
     *     )
     * )
     */
    final public function store(DeveloperRequest $request): JsonResponse
    {
        return DeveloperResource::make(
            $this->developerService->create(
                DeveloperDto::fromRequest($request->validated())->toArray()
            )
        )
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *     path="/api/desenvolvedores/{id}",
     *     summary="Atualiza um desenvolvedor existente",
     *     description="Atualiza os dados de um desenvolvedor existente",
     *     tags={"Desenvolvedores"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do desenvolvedor",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *                  schema="Desenvolvedor",
     *                  type="object",
     *                  title="Desenvolvedor",
     *                  required={"nome", "hobby", "nivel_id", "sexo", "data_nascimento"},
     *                  @OA\Property(
     *                      property="id",
     *                      type="integer",
     *                      description="ID do desenvolvedor"
     *                  ),
     *                  @OA\Property(
     *                      property="nome",
     *                      type="string",
     *                      description="Nome do desenvolvedor"
     *                  ),
     *                  @OA\Property(
     *                      property="hobby",
     *                      type="string",
     *                      description="Hobby do desenvolvedor"
     *                  ),
     *                  @OA\Property(
     *                      property="sexo",
     *                      type="string",
     *                      description="Sexo do desenvolvedor"
     *                  ),
     *                  @OA\Property(
     *                      property="data_nascimento",
     *                      type="string",
     *                      format="date",
     *                      description="Data de nascimento do desenvolvedor"
     *                  ),
     *                  @OA\Property(
     *                      property="nivel_id",
     *                      type="integer",
     *                      description="ID do nível do desenvolvedor"
     *                  ),
     *                  @OA\Property(
     *                      property="idade",
     *                      type="integer",
     *                      description="Idade do desenvolvedor",
     *                      readOnly=true
     *                  )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Desenvolvedor atualizado",
     *         @OA\JsonContent(
     *                  schema="Desenvolvedor",
     *                  type="object",
     *                  title="Desenvolvedor",
     *                  required={"nome", "hobby", "nivel_id", "sexo", "data_nascimento"},
     *                  @OA\Property(
     *                       property="id",
     *                       type="integer",
     *                       description="ID do desenvolvedor"
     *                   ),
     *                   @OA\Property(
     *                       property="nome",
     *                       type="string",
     *                       description="Nome do desenvolvedor"
     *                   ),
     *                   @OA\Property(
     *                       property="hobby",
     *                       type="string",
     *                       description="Hobby do desenvolvedor"
     *                   ),
     *                   @OA\Property(
     *                       property="sexo",
     *                       type="string",
     *                       description="Sexo do desenvolvedor"
     *                   ),
     *                   @OA\Property(
     *                       property="data_nascimento",
     *                       type="string",
     *                       format="date",
     *                       description="Data de nascimento do desenvolvedor"
     *                   ),
     *                   @OA\Property(
     *                       property="nivel_id",
     *                       type="integer",
     *                       description="ID do nível do desenvolvedor"
     *                   ),
     *                   @OA\Property(
     *                       property="idade",
     *                       type="integer",
     *                       description="Idade do desenvolvedor",
     *                       readOnly=true
     *                   )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Desenvolvedor não encontrado"
     *     )
     * )
     */
    final public function update(DeveloperRequest $request, int $id): JsonResponse
    {
        try {
            return DeveloperResource::make(
                $this->developerService->update(
                    $id,
                    DeveloperDto::fromRequest($request->validated())->toArray()
                )
            )
                ->response()
                ->setStatusCode(Response::HTTP_ACCEPTED);
        } catch (\Throwable $throwable) {
            return $this->responseError($throwable->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/desenvolvedores/{id}",
     *     summary="Exclui um desenvolvedor",
     *     description="Exclui um desenvolvedor existente",
     *     tags={"Desenvolvedores"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do desenvolvedor",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Desenvolvedor excluído com sucesso."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Desenvolvedor não encontrado."
     *     )
     * )
     */
    final public function destroy(int $id): JsonResponse
    {
        try {
            $this->developerService->delete($id);
            return $this->responseSuccess(
                message: 'Desenvolvedor excluído com sucesso.',
                status: Response::HTTP_NO_CONTENT
            );
        } catch (\Throwable $throwable) {
            return $this->responseError($throwable->getMessage());
        }
    }
}
