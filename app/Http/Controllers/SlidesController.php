<?php

namespace App\Http\Controllers;

use App\SemanticSEO\PresentationDigitalDocument;
use Illuminate\Http\Response;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;
use Statamic\Entries\Entry;
use Statamic\Facades\Entry as Entries;

class SlidesController extends Controller
{
    public function show(string $slug): Response
    {
        $talk = $this->findTalkWithSlides($slug) ?? $this->findTalkWithSlides("{$slug}-talk");
        $slides = "/slides/{$slug}.pdf";

        if (is_null($talk) || ! file_exists(public_path($slides))) {
            abort(404);
        }

        SemanticSEO::canonical(url($talk->slidesUrl));
        SemanticSEO::is(new PresentationDigitalDocument($talk));

        return response()->view('slides.show', [
            'talk' => $talk,
            'slides' => $slides,
        ]);
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
