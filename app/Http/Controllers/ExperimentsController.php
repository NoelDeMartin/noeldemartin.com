<?php

namespace App\Http\Controllers;

use App\SemanticSEO\Experiments\FreedomCalculator;
use App\SemanticSEO\Experiments\OnlineMeeting;
use App\SemanticSEO\Experiments\Synonymizer;
use Illuminate\Support\Str;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class ExperimentsController extends Controller
{
    public function freedomCalculator()
    {
        SemanticSEO::meta(trans('seo.freedom_calculator'));

        SemanticSEO::is(FreedomCalculator::class);

        return view('experiments.freedom_calculator');
    }

    public function onlineMeeting()
    {
        SemanticSEO::meta(trans('seo.online_meeting'));

        SemanticSEO::is(OnlineMeeting::class);

        return view('experiments.online_meeting');
    }

    public function synonymizer()
    {
        SemanticSEO::meta(trans('seo.synonymizer'));

        SemanticSEO::is(Synonymizer::class);

        return view('experiments.synonymizer');
    }

    public function synonymizeText()
    {
        $text = explode(' ', request('text'));
        foreach ($text as $key => $word) {
            if (strlen($word) > 2) {
                $originalWord = trim($word);
                $singularWord = Str::singular($originalWord);
                $wordData = app('db')->table('thesaurus')->where('word', $singularWord)->first();
                if (! is_null($wordData)) {
                    $meanings = json_decode($wordData->data);
                    $randomMeaning = $meanings[array_rand($meanings)];
                    $substitution = $randomMeaning->synonyms[array_rand($randomMeaning->synonyms)];
                    if (strcmp($originalWord, $singularWord) !== 0) {
                        $text[$key] = Str::plural($substitution);
                    } else {
                        $text[$key] = $substitution;
                    }
                } else {
                    $text[$key] = $word;
                }
            }
        }

        return implode(' ', $text);
    }
}
