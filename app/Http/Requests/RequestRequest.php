<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'project_id' => ['required', 'exists:projects'],
            'ip_address' => ['required'],
            'path' => ['required'],
            'method' => ['required'],
            'content_type' => ['required'],
            'query_string' => ['nullable'],
            'body' => ['nullable'],
            'user_agent' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
