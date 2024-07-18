<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'name' => ['required'],
            'response_code' => ['required', 'integer'],
            'response_content_type' => ['nullable'],
            'response_body' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
