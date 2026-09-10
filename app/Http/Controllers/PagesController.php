<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\SupportsMarkdown;
use Statamic\Entries\Entry;
use Statamic\Facades\Entry as Entries;
use Statamic\Structures\Page;
use Symfony\Component\HttpFoundation\Response;

class PagesController extends Controller
{
    use SupportsMarkdown;

    public function show(string $slug): Response
    {
        [$slug, $isMarkdown] = $this->parseSlug($slug);

        $rawEntry = Entries::findByUri("/{$slug}", config()->string('statamic.sites.default', 'default'));
        $entry = $rawEntry instanceof Page ? $rawEntry->entry() : $rawEntry;

        if (is_null($entry) || ! ($entry instanceof Entry)) {
            abort(404);
        }

        $isMarkdownPage = (empty($entry->get('template')) || $entry->get('template') === 'projects/show')
            && $slug !== 'home'
            && $entry->uri() !== '/';

        if ($isMarkdown && ! $isMarkdownPage) {
            abort(404);
        }

        if (! $isMarkdownPage) {
            /** @var Response $response */
            $response = $entry->toResponse(request());

            return $response;
        }

        $markdownUrl = url("/{$slug}.md");

        if ($isMarkdown || $this->prefersMarkdown()) {
            return $this->markdownResponse(
                $this->buildPageFrontmatter($entry),
                $this->markdownBodyFromEntry($entry),
                url("/{$slug}"),
            );
        }

        $this->advertiseMarkdown($markdownUrl);

        /** @var Response $response */
        $response = $entry->toResponse(request());

        return $this->withMarkdownHeaders($response, $markdownUrl);
    }

    /**
     * @return array<string, mixed>
     */
    protected function buildPageFrontmatter(Entry $page): array
    {
        return [
            'title' => $page->value('title'),
        ];
    }
}
