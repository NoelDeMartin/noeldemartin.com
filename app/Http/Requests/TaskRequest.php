<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    use Concerns\AuthorizesRequests;

    public function rules()
    {
        return [
            'name'                 => 'required',
            'description_html'     => 'required',
            'description_markdown' => 'required',
        ];
    }
}
