<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Traits\ForwardsCalls;

class AbstractService implements BaseMethodInterface
{
    use ForwardsCalls, BaseMethodTrait;

    protected Model|Builder $model;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(mixed $model = null)
    {
        $this->model = $model ?? $this->resolveModel();
    }

    public function __call(string $name, mixed $arguments): static
    {
        $result = $this->forwardCallTo($this->model, $name, $arguments);

        if ($result === $this->model) {
            return $this;
        }

        return $result;
    }

    public function __get(string $name): mixed
    {
        return $this->model->{$name};
    }

    public function __set(string $name, mixed $value): void
    {
        $this->model->{$name} = $value;
    }

    public function __isset(string $name): bool
    {
        return isset($this->model->{$name});
    }

    /**
     * @throws BindingResolutionException
     * @throws \Exception
     */
    private function resolveModel(): Model
    {
        $model = app()->make($this->model);

        if (!$model instanceof Model) {
            throw new \RuntimeException(
                "Class {$this->model} must be an instance of Illuminate\\Database\\Eloquent\\Model"
            );
        }
        return $model;
    }
}
