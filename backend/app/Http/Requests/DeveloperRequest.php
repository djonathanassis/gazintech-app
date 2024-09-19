<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class DeveloperRequest extends FormRequest
{
    final public function authorize(): bool
    {
        return true;
    }

    final public function rules(): array
    {
        return [
            'nivel_id' => ['required', 'exists:levels,id'],
            'nome' => ['required', 'string', 'min:2', 'max:255'],
            'sexo' => ['required', 'string', 'in:M,F'],
            'data_nascimento' => ['required', 'date'],
            'hobby' => ['required', 'string', 'max:255'],
        ];
    }

    final public function messages(): array
    {
        return [
            'nivel_id.required' => 'O campo level_id é obrigatório',
            'nivel_id.exists' => 'O level_id informado não existe',
            'nome.required' => 'O campo name é obrigatório',
            'hobby.required' => 'O campo nivel é obrigatório.',
        ];
    }

    final public function failedValidation(Validator $validator): void
    {
        $exception = new ($validator->getException())($validator);
        $exception->status(Response::HTTP_BAD_REQUEST);

        throw $exception;
    }
}
