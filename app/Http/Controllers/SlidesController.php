<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\SupportsMarkdown;
use App\SemanticSEO\PresentationDigitalDocument;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;
use Statamic\Entries\Entry;
use Statamic\Facades\Entry as Entries;
use Symfony\Component\HttpFoundation\Response;

class SlidesController extends Controller
{
    use SupportsMarkdown;

    public function show(string $slug): Response
    {
        [$slug, $isMarkdown] = $this->parseSlug($slug);

        if ($isMarkdown) {
            abort(404);
        }

        $talk = $this->findTalkWithSlides($slug) ?? $this->findTalkWithSlides("{$slug}-talk");
        $slides = "/slides/{$slug}.pdf";

        if (is_null($talk) || ! file_exists(public_path($slides))) {
            abort(404);
        }

        $markdownUrl = url("/talks/{$slug}.md");
        $this->advertiseMarkdown($markdownUrl);

        SemanticSEO::canonical(url($talk->slidesUrl));
        SemanticSEO::is(new PresentationDigitalDocument($talk));

        /** @var Response $response */
        $response = response()->view('slides.show', [
            'talk' => $talk,
            'slides' => $slides,
        ]);

        return $this->withMarkdownHeaders($response, $markdownUrl);
    }

    private function findTalkWithSlides(string $slug): ?Entry
    {
        $talk = Entries::find($slug);

        if (is_null($talk) || ! ($talk instanceof Entry) || $talk->collectionHandle() !== 'talks') {
            return null;
        }

        return $talk;
    }
}
