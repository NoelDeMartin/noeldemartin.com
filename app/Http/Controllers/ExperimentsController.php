<?php namespace App\Http\Controllers;

use DB;
use View;
use Input;

class ExperimentsController extends Controller {

	function freedomCalculator() {
		return View::make('experiments.freedom_calculator', ['title' => 'Freedom Calculator']);
	}

	function onlineMeeting() {
		return View::make('experiments.online_meeting', ['title' => 'Online Meeting Tool']);
	}

	function onlineMeetingRoom($roomKey) {
		return View::make('experiments.online_meeting_room', ['roomKey' => $roomKey, 'title' => 'Online Meeting Tool']);
	}

	function synonymizer() {
		return View::make('experiments.synonymizer', ['title' => 'Random Synonymizer']);
	}

	function synonymizeText() {
		$text = explode(' ', Input::get('text'));
		foreach ($text as $key => $word) {
			if (strlen($word) > 2) {
				$originalWord = trim($word);
				$singularWord = str_singular($originalWord);
				$wordData = DB::table('thesaurus')->where('word', $singularWord)->first();
				if (!is_null($wordData)) {
					$meanings = json_decode($wordData->data);
					$randomMeaning = $meanings[array_rand($meanings)];
					$substitution = $randomMeaning->synonyms[array_rand($randomMeaning->synonyms)];
					if (strcmp($originalWord, $singularWord) != 0) {
						$text[$key] = str_plural($substitution);
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
