<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use App\SemanticSEO\Logo;
use Illuminate\Support\Carbon;
use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\Experiments\Synonymizer;
use App\SemanticSEO\NoelDeMartinOrganization;
use App\SemanticSEO\Experiments\OnlineMeeting;
use App\SemanticSEO\Experiments\DCMotorSandbox;
use App\SemanticSEO\Experiments\FreedomCalculator;
use App\SemanticSEO\Experiments\ZazenMeditationTimer;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;
use App\SemanticSEO\Experiments\JapaneseCharacterRecognition;

class HomeController extends Controller
{
    public function about()
    {
        SemanticSEO::meta(trans('seo.home'));
        SemanticSEO::canonical(route('home'));

        SemanticSEO::website()
            ->setAttributes(trans('seo.schema:website'))
            ->url(route('home'))
            ->image(Logo::class)
            ->discussionUrl('https://twitter.com/NoelDeMartin')
            ->inLanguage('English')
            ->about(NoelDeMartin::class)
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class)
            ->datePublished(Carbon::create(2014, 10, 24)->startOfDay())
            ->dateCreated(Carbon::create(2014, 10, 24)->startOfDay());
            // TODO ->dateModified(); git log -1 --format=%cd or Post::last()->updated_at

        SemanticSEO::is(NoelDeMartin::class);

        SemanticSEO::about()
            ->setAttributes(trans('seo.schema:about'))
            ->url(route('home'))
            ->about(NoelDeMartin::class)
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class);

        return view('about');
    }

    public function blog()
    {
        // TODO pagination
        $posts =
            Post::where('published_at', '<', now())
                ->orderBy('published_at', 'desc')
                ->get();

        SemanticSEO::meta(trans('seo.blog'));

        SemanticSEO::blog()
            ->setAttributes(trans('seo.schema:blog'))
            ->url(route('blog'))
            ->image(Logo::class)
            ->sameAs([
                'https://medium.com/@NoelDeMartin',
                'https://steemit.com/@noeldemartin',
            ])
            ->discussionUrl('https://twitter.com/NoelDeMartin')
            ->inLanguage('English')
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class)
            ->datePublished(Carbon::create(2014, 10, 24)->startOfDay())
            ->dateCreated(Carbon::create(2014, 10, 24)->startOfDay())
            ->dateModified($posts->first()->updated_at);

        return view('blog', compact('posts'));
    }

    public function rss()
    {
        $posts =
            Post::where('published_at', '<', now())
                ->orderBy('published_at', 'desc')
                ->get();

        return response()
            ->view('blog.rss', compact('posts'))
            ->header('Content-Type', 'application/atom+xml');
    }

    public function experiments()
    {
        SemanticSEO::meta(trans('seo.experiments'));

        SemanticSEO::collection()
            ->setAttributes(trans('seo.schema:experiments'))
            ->url(route('experiments'))
            ->hasPart([
                Synonymizer::class,
                OnlineMeeting::class,
                FreedomCalculator::class,
                JapaneseCharacterRecognition::class,
                ZazenMeditationTimer::class,
                DCMotorSandbox::class,
            ])
            ->image(Logo::class)
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class);

        return view('experiments');
    }

    public function health()
    {
        $status = 'Everything is OK';
        try {
            if (!app('db')->connection()) {
                $status = 'MySQL is not working correctly';
            }
        } catch (Exception $e) {
            $status = 'MySQL is not working correctly';
        }

        return $status;
    }
}
