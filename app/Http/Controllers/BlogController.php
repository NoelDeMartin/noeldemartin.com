<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\SupportsMarkdown;
use DateTimeInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Statamic\Entries\Entry as EntryModel;
use Statamic\Facades\Entry;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class BlogController extends Controller
{
    use SupportsMarkdown;

    public function show(string $slug): SymfonyResponse
    {
        [$slug, $isMarkdown] = $this->parseSlug($slug);

        /** @var EntryModel|null $post */
        $post = Entry::whereCollection('posts')->firstWhere('slug', $slug);

        if (is_null($post)) {
            abort(404);
        }

        $markdownUrl = url("/blog/{$slug}.md");

        if ($isMarkdown || $this->prefersMarkdown()) {
            return $this->markdownResponse(
                $this->buildPostFrontmatter($post),
                $this->markdownBodyFromEntry($post),
                url("/blog/{$slug}"),
            );
        }

        $this->advertiseMarkdown($markdownUrl);

        /** @var SymfonyResponse $response */
        $response = $post->toResponse(request());

        return $this->withMarkdownHeaders($response, $markdownUrl);
    }

    public function feed(): Response
    {
        /**
         * @var string
         */
        $xml = Cache::remember('blog-rss', 3600, function () {
            $posts = Entry::whereCollection('posts')->sortByDesc('publication_date')->all();

            return view('blog.rss', ['posts' => $posts])->render();
        });

        return response($xml)
            ->header('Content-Type', 'application/xml');
    }

    public function styles(): Response
    {
        return response()
            ->view('blog.styles')
            ->header('Content-Type', 'text/xml');
    }

    /**
     * @return array<string, mixed>
     */
    protected function buildPostFrontmatter(EntryModel $post): array
    {
        $frontmatter = [
            'title' => $post->value('title'),
        ];

        if ($post->publication_date instanceof Carbon) {
            $frontmatter['date'] = $post->publication_date->toIso8601String();
        }

        if (
            $post->modification_date instanceof Carbon
            && $post->publication_date instanceof DateTimeInterface
            && ! $post->modification_date->eq($post->publication_date)
        ) {
            $frontmatter['updated'] = $post->modification_date->toIso8601String();
        }

        return $frontmatter;
    }
}
