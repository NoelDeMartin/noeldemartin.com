<?php

namespace App\Http\Controllers;

use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;
use Parsedown;

class RecipesController extends Controller
{
    public function show($slug)
    {
        $filepath = storage_path("recipes/$slug.md");

        if (!file_exists($filepath))
            abort(404);

        SemanticSEO::hide();

        $parsedown = new Parsedown;

        return view('recipes.show', [
            'recipeHtml' => $parsedown->text(file_get_contents($filepath)),
        ]);
    }
}
