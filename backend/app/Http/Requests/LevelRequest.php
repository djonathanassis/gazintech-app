<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class LevelRequest extends FormRequest
{
    final public function authorize(): bool
    {
        return true;
    }

    final public function rules(): array
    {
        return [
            'nivel' => ['required', 'string', 'max:100'],
        ];
    }

    final public function messages(): array
    {
        return [
            'nivel.required' => 'O campo level é obrigatório',
            'nivel.string' => 'O campo level deve ser uma string',
            'nivel.max' => 'O campo level deve ter no máximo 255 caracteres',
        ];
    }

    final public function failedValidation(Validator $validator): void
    {
        $exception = new ($validator->getException())($validator);
        $exception->status(Response::HTTP_BAD_REQUEST);

        throw $exception;
    }
}
