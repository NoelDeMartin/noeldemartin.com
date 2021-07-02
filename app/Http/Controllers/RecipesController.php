<?php

namespace App\Http\Controllers;

use App\Support\Parsedown;
use Illuminate\Support\Str;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class RecipesController extends Controller
{

    public function show($slug)
    {
        $filepath = storage_path("recipes/$slug.md");

        if (!file_exists($filepath))
            abort(404);

        $markdown = file_get_contents($filepath);
        $title = $this->getRecipeTitle($markdown);

        $markdown = str_replace(
            ':email-url:',
            'mailto:hey@noeldemartin.com?subject=' . rawurlencode($title . ' pics'),
            $markdown
        );

        SemanticSEO::hide();
        SemanticSEO::title($title);

        return view('recipes.show', [
            'recipeHtml' => Parsedown::render($markdown),
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
