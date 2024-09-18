<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            'level' => ['required', 'string', 'max:100'],
        ];
    }

    final public function messages(): array
    {
        return [
            'level.required' => 'O campo level é obrigatório',
            'level.string' => 'O campo level deve ser uma string',
            'level.max' => 'O campo level deve ter no máximo 255 caracteres',
        ];
    }

    final public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json($validator->errors(), Response::HTTP_BAD_REQUEST));
    }
}
