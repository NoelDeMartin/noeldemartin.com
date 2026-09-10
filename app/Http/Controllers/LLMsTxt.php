<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\BroadcastsSiteContent;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class LLMsTxt extends Controller
{
    use BroadcastsSiteContent;

    public function __invoke(): Response
    {
        /** @var string $content */
        $content = Cache::remember('llms.txt', 3600, fn () => view('llms.index', $this->getSiteContent())->render());

        return response($content)->header('Content-Type', 'text/plain; charset=utf-8');
    }
}
