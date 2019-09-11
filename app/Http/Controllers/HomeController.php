<?php

namespace App\Http\Controllers;

use App\Models\ActivityEvent;
use App\Models\Post;
use App\Models\Task;
use App\Models\TaskComment;
use App\SemanticSEO\BlogPost;
use App\SemanticSEO\Experiments\DCMotorSandbox;
use App\SemanticSEO\Experiments\FreedomCalculator;
use App\SemanticSEO\Experiments\JapaneseCharacterRecognition;
use App\SemanticSEO\Experiments\OnlineMeeting;
use App\SemanticSEO\Experiments\Synonymizer;
use App\SemanticSEO\Experiments\ZazenMeditationTimer;
use App\SemanticSEO\ItemList;
use App\SemanticSEO\Logo;
use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use App\SemanticSEO\WebPage;
use Exception;
use Illuminate\Support\Carbon;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;
use NoelDeMartin\SemanticSEO\Types\AboutPage;
use NoelDeMartin\SemanticSEO\Types\Blog;
use NoelDeMartin\SemanticSEO\Types\CollectionPage;

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
            ->hasPart([
                (new AboutPage)
                    ->setAttributes(trans('seo.schema:about'))
                    ->url(route('home')),
                (new Blog)
                    ->setAttributes(trans('seo.schema:blog'))
                    ->url(route('blog')),
                (new CollectionPage)
                    ->setAttributes(trans('seo.schema:experiments'))
                    ->url(route('experiments')),
                (new WebPage)
                    ->setAttributes(trans('seo.schema:now'))
                    ->url(route('now')),
            ])
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
            ->hasPart($posts->map(function ($post) {
                return new BlogPost($post);
            })->all())
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

    public function now()
    {
        $tasks = Task::whereNull('completed_at')->orderBy('created_at', 'desc')->get();

        $events = collect()
            ->merge(ActivityEvent::fromTasks(Task::all()))
            ->merge(ActivityEvent::fromTaskComments(TaskComment::with('task')->get()))
            ->merge(ActivityEvent::fromPosts(Post::all()))
            ->sortByDesc->date;

        SemanticSEO::meta(trans('seo.now'));

        SemanticSEO::is(WebPage::class)
            ->setAttributes(trans('seo.schema:now'))
            ->url(route('now'))
            ->image(Logo::class)
            ->discussionUrl('https://twitter.com/NoelDeMartin')
            ->inLanguage('English')
            ->about(NoelDeMartin::class)
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class)
            ->datePublished(Carbon::create(2018, 11, 11)->startOfDay())
            ->dateCreated(Carbon::create(2018, 11, 11)->startOfDay())
            ->dateModified($events->first()->date);

        return view('now', compact('tasks', 'events'));
    }

    public function sitemap()
    {
        $posts =
            Post::where('published_at', '<', now())
                ->orderBy('published_at', 'desc')
                ->get();

        $tasks = Task::with('comments')->get();

        $nowLastModifiedAt = $this->getNowLastModifiedAt($posts, $tasks);

        return response()
            ->view('sitemap', compact('posts', 'tasks', 'nowLastModifiedAt'))
            ->header('Content-Type', 'application/xml');
    }

    public function health()
    {
        $status = 'Everything is OK';

        try {
            if (! app('db')->connection()) {
                $status = 'MySQL is not working correctly';
            }
        } catch (Exception $e) {
            $status = 'MySQL is not working correctly';
        }

        return $status;
    }

    protected function getNowLastModifiedAt($posts, $tasks)
    {
        $dates = [
            $posts->last()->published_at,
            $tasks->last()->created_at,
        ];

        foreach ($tasks as $task) {
            if ($task->isCompleted()) {
                $dates[] = $task->completed_at;
            }
        }

        $dates[] = TaskComment::orderBy('created_at', 'desc')->first()->created_at;

        return max($dates);
    }
}
