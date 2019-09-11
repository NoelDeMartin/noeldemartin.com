<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostCommentRequest extends FormRequest
{
    use Concerns\AuthorizesRequests;

    public function rules()
    {
        return [
            'author'      => 'max:64',
            'author_link' => '', // TODO email_or_url
            'text'        => 'required|max:2048',
        ];
    }
}
