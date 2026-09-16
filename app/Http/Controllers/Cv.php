<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;
use NoelDeMartin\SemanticSEO\Support\Facades\SemanticSEO;

class Cv extends Controller
{
    public function __invoke(): View
    {
        SemanticSEO::canonical(route('cv'));
        SemanticSEO::title('CV | Noel De Martin');

        $cv = json_decode(
            File::get(base_path('content/json/cv.json')),
            associative: true,
            flags: JSON_THROW_ON_ERROR,
        );

        $workLandmarks = [];

        foreach ($cv['work'] as $work) {
            $workLandmarks[] = (object) [
                'level' => 3,
                'title' => explode('-', $work['startDate'])[0] . ' - ' . $work['position'] . ' at ' . $work['name'],
                'anchor' => '#work-' . Str::slug($work['name']),
            ];
        }

        $educationLandmarks = [];

        foreach ($cv['education'] as $education) {
            $educationLandmarks[] = (object) [
                'level' => 3,
                'title' => explode('-', $education['startDate'])[0] . ' - ' . $education['studyType'] . ' at ' . $education['institution'],
                'anchor' => '#education-' . Str::slug($education['institution']),
            ];
        }

        return view('cv', [
            'landmarks' => [
                (object) [
                    'level' => 2,
                    'title' => 'Work History',
                    'anchor' => '#work-history',
                    'children' => $workLandmarks,
                ],
                (object) [
                    'level' => 2,
                    'title' => 'Side Projects & Open Source',
                    'anchor' => '#side-projects',
                ],
                (object) [
                    'level' => 2,
                    'title' => 'Education',
                    'anchor' => '#education',
                    'children' => $educationLandmarks,
                ],
            ],
            'cv' => $cv,
            'basics' => $cv['basics'],
            'work' => $cv['work'],
            'sideProjects' => $cv['projects'][0],
            'education' => $cv['education'],
        ]);
    }
}
