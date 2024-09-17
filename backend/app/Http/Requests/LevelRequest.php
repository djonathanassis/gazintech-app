<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LevelRequest extends FormRequest
{
    final public function authorize(): bool
    {
        return true;
    }

    final public function rules(): array
    {
        return [
            'level' => ['required', 'string', 'max:255'],
        ];
    }

    final public function messages(): array
    {
        return [
            'level.required' => 'O campo level é obrigatório',
        ];
    }
}
