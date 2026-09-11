<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\BroadcastsSiteContent;
use App\Http\Controllers\Concerns\SupportsMarkdown;
use Illuminate\Support\Facades\Cache;
use Statamic\Entries\Entry;
use Statamic\Facades\Entry as Entries;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    use BroadcastsSiteContent, SupportsMarkdown;

    public function html(): Response
    {
        if ($this->prefersMarkdown()) {
            return $this->markdown(true);
        }

        $markdownUrl = url('/llms.txt');

        $this->advertiseMarkdown($markdownUrl);

        /** @var Entry $entry */
        $entry = Entries::find('home');

        /** @var Response $response */
        $response = $entry->toResponse(request());

        return $this->withMarkdownHeaders($response, $markdownUrl);
    }

    public function markdown(bool $vary = false): Response
    {
        /** @var string $content */
        $content = Cache::remember('home-markdown', 3600, fn () => view('home.markdown', $this->getSiteContent())->render());
        $tokens = (int) ceil(mb_strlen($content) / 4);
        $response = response($content)
            ->header('Content-Type', 'text/markdown; charset=utf-8')
            ->header('Content-Signal', 'search=yes, ai-input=yes, ai-train=yes')
            ->header('x-markdown-tokens', (string) $tokens);

        if ($vary) {
            $response->header('Vary', 'Accept');
        }

        return $response;
    }
}
