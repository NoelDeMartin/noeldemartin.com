<?php

namespace App\Http\Controllers;

use App\Models\ActivityEvent;
use App\Models\Post;
use App\Models\Task;
use App\Models\TaskComment;
use App\SemanticSEO\BlogPost;
use App\SemanticSEO\Experiments\DCMotorSandbox;
use App\SemanticSEO\Experiments\JapaneseCharacterRecognition;
use App\SemanticSEO\Experiments\OnlineMeeting;
use App\SemanticSEO\Experiments\Synonymizer;
use App\SemanticSEO\Experiments\ZazenMeditationTimer;
use App\SemanticSEO\Logo;
use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use App\SemanticSEO\WebPage;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;
use NoelDeMartin\SemanticSEO\Types\AboutPage;
use NoelDeMartin\SemanticSEO\Types\Blog;
use NoelDeMartin\SemanticSEO\Types\CollectionPage;

class HomeController extends Controller
{
    public function index()
    {
        SemanticSEO::meta(trans('seo.home'));
        SemanticSEO::canonical(route('home'));

        SemanticSEO::website()
            ->setAttributes(trans('seo.schema:website'))
            ->url(route('home'))
            ->image(Logo::class)
            ->discussionUrl($this->discussionUrls)
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
                (new WebPage)
                    ->setAttributes(trans('seo.schema:site'))
                    ->url(route('site')),
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

        return view('index');
    }

    public function blog()
    {
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
            ->discussionUrl($this->discussionUrls)
            ->inLanguage('English')
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class)
            ->datePublished(Carbon::create(2014, 10, 24)->startOfDay())
            ->dateCreated(Carbon::create(2014, 10, 24)->startOfDay())
            ->dateModified($posts->first()->updated_at);

        return view('blog.index', compact('posts'));
    }

    public function blogRss()
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
        $events = $this->getActivityEvents()->groupBy(function (ActivityEvent $event) {
            return $event->date->year;
        });
        $updatedAt = $events->first()->first()->date;

        SemanticSEO::meta(trans('seo.now'));

        SemanticSEO::is(WebPage::class)
            ->setAttributes(trans('seo.schema:now'))
            ->url(route('now'))
            ->image(Logo::class)
            ->discussionUrl($this->discussionUrls)
            ->inLanguage('English')
            ->about(NoelDeMartin::class)
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class)
            ->datePublished(Carbon::create(2018, 11, 11)->startOfDay())
            ->dateCreated(Carbon::create(2018, 11, 11)->startOfDay())
            ->dateModified($updatedAt);

        return view('now.index', compact('tasks', 'events', 'updatedAt'));
    }

    public function nowRss()
    {
        $events = $this->getActivityEvents();

        return response()
            ->view('now.rss', compact('events'))
            ->header('Content-Type', 'application/atom+xml');
    }

    public function talks()
    {
        SemanticSEO::meta(trans('seo.talks'));

        SemanticSEO::is(WebPage::class)
            ->setAttributes(trans('seo.schema:talks'))
            ->url(route('talks'))
            ->image(Logo::class)
            ->discussionUrl($this->discussionUrls)
            ->inLanguage('English')
            ->about(NoelDeMartin::class)
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class);

        return view('talks');
    }

    public function japanTips()
    {
        SemanticSEO::meta(trans('seo.japan-tips'));

        SemanticSEO::is(WebPage::class)
            ->setAttributes(trans('seo.schema:japan-tips'))
            ->url(route('japan-tips'))
            ->image(Logo::class)
            ->discussionUrl($this->discussionUrls)
            ->inLanguage('English')
            ->about((new WebPage)->url(route('home')))
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class);

        return view('japan-tips');
    }

    public function site()
    {
        SemanticSEO::meta(trans('seo.site'));

        SemanticSEO::is(WebPage::class)
            ->setAttributes(trans('seo.schema:site'))
            ->url(route('site'))
            ->image(Logo::class)
            ->discussionUrl($this->discussionUrls)
            ->inLanguage('English')
            ->about((new WebPage)->url(route('home')))
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class);

        return view('site');
    }

    public function moodlenet()
    {
        SemanticSEO::meta(trans('seo.moodlenet'));

        SemanticSEO::is(WebPage::class)
            ->setAttributes(trans('seo.schema:moodlenet'))
            ->url(route('moodlenet'))
            ->image(Logo::class)
            ->discussionUrl($this->discussionUrls)
            ->inLanguage('English')
            ->about((new WebPage)->url(route('home')))
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class);

        return view('moodlenet');
    }

    public function sitemap()
    {
        $posts =
            Post::where('published_at', '<', now())
                ->orderBy('published_at', 'desc')
                ->get();

        $tasks = Task::with('comments')->get();

        $projects = ['beastmasters', 'geemba'];

        $lastModificationDate = $this->getSiteLastModificationDate($posts, $tasks);

        return response()
            ->view('sitemap', compact('posts', 'tasks', 'projects', 'lastModificationDate'))
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

    protected function getActivityEvents()
    {
        $lastModificationDate = $this->getSiteLastModificationDate();

        return Cache::remember(
            'events_' . $lastModificationDate->timestamp,
            86400, // 24 hours
            function () {
                return collect()
                    ->merge(ActivityEvent::fromTasks(Task::with('comments')->get()))
                    ->merge(ActivityEvent::fromTaskComments(TaskComment::with('task')->get()))
                    ->merge(ActivityEvent::fromPosts(Post::all()))
                    ->sortByDesc->date;
            }
        );
    }

    protected function getSiteLastModificationDate()
    {
        return collect([
            Task::orderByDesc('created_at')->first()->created_at,
            Task::orderByDesc('completed_at')->first()->completed_at,
            TaskComment::orderByDesc('created_at')->first()->created_at,
            Post::orderByDesc('published_at')->first()->published_at,
        ])
            ->sort()
            ->last();
    }
}
