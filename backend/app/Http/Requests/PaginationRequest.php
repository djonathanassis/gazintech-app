<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class PaginationRequest extends FormRequest
{
    final public function authorize(): bool
    {
        return true;
    }

    final public function rules(): array
    {
        return [
            'search' => [
                'sometimes',
                'string',
            ],
            'sort' => [
                'sometimes',
                'string',
            ],
            'order' => [
                'sometimes',
                'in:asc,desc',
            ],
            'page' => [
                'sometimes',
                'integer',
            ],
            'per_page' => [
                'sometimes',
                'integer',
            ],
        ];
    }

    final public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json($validator->errors(), Response::HTTP_BAD_REQUEST));
    }
}
