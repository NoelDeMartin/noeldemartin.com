<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;
use Parsedown;

class RecipesController extends Controller
{

    public function show($slug)
    {
        $filepath = storage_path("recipes/$slug.md");

        if (!file_exists($filepath))
            abort(404);

        $parsedown = new Parsedown;
        $markdown = file_get_contents($filepath);
        $title = $this->getRecipeTitle($markdown);

        $markdown = str_replace(
            ':email-url:',
            'mailto:noeldemartin@gmail.com?subject=' . rawurlencode($title . ' pics'),
            $markdown
        );

        SemanticSEO::hide();
        SemanticSEO::title($title);

        return view('recipes.show', [
            'recipeHtml' => $parsedown->text($markdown),
        ]);
    }

    private function getRecipeTitle($markdown)
    {
        [$header, ] = explode("\n", trim($markdown), 2);

        if (!Str::startsWith($header, '# ')) {
            return 'Recipe';
        }

        return Str::substr($header, 2) . ' recipe';
    }

}
