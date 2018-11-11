<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCommentRequest extends FormRequest
{
    use Concerns\AuthorizesRequests;

    public function rules()
    {
        return [
            'text_html'     => 'required',
            'text_markdown' => 'required',
        ];
    }
}
