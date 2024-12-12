<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Repository\Interface\RepositoryInterface;
use App\Repository\Trait\BaseMethodTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\ForwardsCalls;
use RuntimeException;

class EloquentRepository implements RepositoryInterface
{
    use ForwardsCalls, BaseMethodTrait;

    private ?Model $model;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(
        private readonly Container $container,
        ?string $modelName = null
    ) {
        $this->model = $modelName ? $this->resolveModel($modelName) : null;
    }

    /**
     * @throws BindingResolutionException
     */
    public function managerEloquent(string $name = null): self
    {
        $this->model = $this->resolveModel($name);
        return $this;
    }

    /**
     * @throws BindingResolutionException
     */
    private function resolveModel(string $modelName): Model
    {
        $model = $this->container->make($modelName);

        if (!$model instanceof Model) {
            throw new \RuntimeException(
                "Class {$model} must be an instance of Illuminate\\Database\\EloquentRepository\\Model"
            );
        }

        return $model;
    }

    public function __call(string $name, array $arguments): mixed
    {
        if (!$this->model) {
            throw new RuntimeException("Modelo não definido.");
        }

        return $this->forwardCallTo($this->model, $name, $arguments);
    }

    public function __get(string $name): mixed
    {
        return $this->model?->{$name};
    }

    public function __set(string $name, mixed $value): void
    {
        if ($this->model) {
            $this->model->{$name} = $value;
        }
    }

    public function __isset(string $name): bool
    {
        return $this->model && isset($this->model->{$name});
    }
}
