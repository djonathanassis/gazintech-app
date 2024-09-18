<?php

declare(strict_types=1);

namespace App\Services\Level;

use App\Models\Level;
use App\Services\AbstractService;
use Symfony\Component\HttpFoundation\Response;

class LevelService extends AbstractService
{
    public function __construct(Level $model)
    {
        parent::__construct($model);
    }

    public function delete(int $id): void
    {
        $model = $this->model->find($id);

        if (null === $model) {
            abort(
                code: Response::HTTP_BAD_REQUEST,
                message: 'Nível não encontrado.'
            );
        }

        if ($model->developers()->exists()) {
            abort(
                code: Response::HTTP_BAD_REQUEST,
                message: 'Nível associado a desenvolvedores, não pode ser excluído.'
            );
        }

        $model->delete();
    }
}
