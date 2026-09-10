<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\SupportsMarkdown;
use App\Models\Talk;
use Illuminate\Support\Carbon;
use Statamic\Entries\Entry;
use Statamic\Facades\Entry as Entries;
use Symfony\Component\HttpFoundation\Response;

class TalksController extends Controller
{
    use SupportsMarkdown;

    public function show(string $slug): Response
    {
        [$slug, $isMarkdown] = $this->parseSlug($slug);

        /** @var Entry|null $talk */
        $talk = Entries::whereCollection('talks')->firstWhere('slug', $slug)
            ?? Entries::whereCollection('talks')->firstWhere('id', $slug)
            ?? Entries::whereCollection('talks')->firstWhere('id', "{$slug}-talk");

        if (is_null($talk)) {
            abort(404);
        }

        $talkSlug = new Talk($talk)->talkSlug() ?? $slug;
        $slidesPath = "/slides/{$talkSlug}";
        $hasSlides = file_exists(public_path("{$slidesPath}.pdf"));
        $canonicalUrl = $hasSlides ? url($slidesPath) : url('/talks');

        if ($isMarkdown || $this->prefersMarkdown()) {
            return $this->markdownResponse(
                $this->buildTalkFrontmatter($talk, $talkSlug, $hasSlides),
                $this->markdownBodyFromEntry($talk),
                $canonicalUrl,
            );
        }

        if ($hasSlides) {
            return redirect($slidesPath);
        }

        return redirect('/talks');
    }

    /**
     * @return array<string, mixed>
     */
    protected function buildTalkFrontmatter(Entry $talk, string $slug, bool $hasSlides): array
    {
        $frontmatter = [
            'title' => $talk->value('title'),
        ];

        if ($talk->presentation_date instanceof Carbon) {
            $frontmatter['date'] = $talk->presentation_date->toIso8601String();
        }

        if ($talk->value('conference')) {
            $frontmatter['conference'] = $talk->value('conference');
        }

        if ($talk->value('location')) {
            $frontmatter['location'] = $talk->value('location');
        }

        if ($talk->value('video_url')) {
            $frontmatter['video_url'] = $talk->value('video_url');
        }

        if ($hasSlides) {
            $frontmatter['slides'] = url("/slides/{$slug}.pdf");
        }

        return $frontmatter;
    }
}
