<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeveloperRequest extends FormRequest
{
    final public function authorize(): bool
    {
        return true;
    }

    final public function rules(): array
    {
        return [
            'level_id' => ['required', 'exists:levels'],
            'name' => ['required'],
            'sex' => ['required'],
            'dt_birth' => ['required', 'date'],
            'hobby' => ['required'],
        ];
    }

    final public function messages(): array
    {
        return [
            'level_id.required' => 'O campo level_id é obrigatório',
            'level_id.exists' => 'O level_id informado não existe',
            'name.required' => 'O campo name é obrigatório',
            'idade.required' => 'O campo Idade é obrigatório.',
            'hobby.required' => 'O campo nivel é obrigatório.',

        ];
    }
}
