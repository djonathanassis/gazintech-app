<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            'level_id' => ['required', 'exists:levels,id'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'sex' => ['required', 'string', 'in:M,F'],
            'dt_birth' => ['required', 'date'],
            'hobby' => ['required', 'string', 'max:255'],
        ];
    }

    final public function messages(): array
    {
        return [
            'level_id.required' => 'O campo level_id é obrigatório',
            'level_id.exists' => 'O level_id informado não existe',
            'name.required' => 'O campo name é obrigatório',
            'hobby.required' => 'O campo nivel é obrigatório.',
        ];
    }

    final public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json($validator->errors(), Response::HTTP_BAD_REQUEST));
    }
}
