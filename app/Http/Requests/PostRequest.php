<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    use Concerns\AuthorizesRequests;

    public function rules()
    {
        return [
            'title'         => 'required',
            'text_html'     => 'required',
            'text_markdown' => 'required',
            'published_at'  => 'required|date',
        ];
    }
}
