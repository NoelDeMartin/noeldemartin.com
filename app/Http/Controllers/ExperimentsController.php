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
			$wordData = DB::table('synonyms')->where('word', $word)->first();
			if (!is_null($wordData)) {
				$synonyms = json_decode($wordData->synonyms);
				$text[$key] = $synonyms[array_rand($synonyms)];
			} else {
				$text[$key] = $word;
			}
		}
		return implode(' ', $text);
	}

}
