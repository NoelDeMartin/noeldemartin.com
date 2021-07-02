<?php

namespace App\Http\Controllers;

use App\SemanticSEO\Logo;
use App\SemanticSEO\NoelDeMartin;
use App\SemanticSEO\NoelDeMartinOrganization;
use App\SemanticSEO\Project;
use App\SemanticSEO\WebPage;
use App\Support\Parsedown;
use Illuminate\Support\Facades\File;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class ProjectsController extends Controller {

    public function index() {
        SemanticSEO::meta(trans('seo.projects'));
        SemanticSEO::is(WebPage::class)
            ->setAttributes(trans('seo.schema:projects'))
            ->url(route('projects.index'))
            ->image(Logo::class)
            ->discussionUrl($this->discussionUrls)
            ->inLanguage('English')
            ->about((new WebPage)->url(route('home')))
            ->author(NoelDeMartin::class)
            ->creator(NoelDeMartin::class)
            ->publisher(NoelDeMartinOrganization::class);

        return view('projects.index');
    }

    public function show($slug) {
        if (!File::exists(storage_path("projects/$slug.md"))) {
            abort(404);
        }

        SemanticSEO::meta(trans("seo.projects.$slug"));
        SemanticSEO::is(new Project($slug));

        [$name, $description] = $this->getProjectInfo($slug);
        $images = $this->getProjectImages($slug);
        $team = $this->getProjectTeam($slug);

        return view("projects.show", compact('slug', 'name', 'description', 'images', 'team'));
    }

    private function getProjectInfo($project) {
        $info = Parsedown::render(File::get(storage_path("projects/$project.md")));

        [$header, $description] = explode("\n", $info, 2);

        preg_match('/<h1[^>]+>([^<]+)<\/h1>/', $header, $matches);

        return [$matches[1], $description];
    }

    private function getProjectImages($project) {
        $imagesPath = "img/projects/$project/images";

        return collect(File::files(public_path($imagesPath)))
            ->map(function ($file, $index) use ($imagesPath) {
                $filename = $file->getFilename();
                $number = $index + 1;

                return [
                    'url' => "/$imagesPath/{$filename}",
                    'description' => "Project image ($number)",
                ];
            })
            ->sortBy('url')
            ->toArray();
    }

    private function getProjectTeam($project) {
        return json_decode(File::get(storage_path("projects/$project-team.json")));
    }

}
