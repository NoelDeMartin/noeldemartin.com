<?php namespace App\Http\Controllers;

use View;

class ExperimentsController extends Controller {

	function freedomCalculator() {
		return View::make('experiments.freedom_calculator', ['title' => 'Freedom Calculator']);
	}

	function onlineMeeting() {
		return View::make('experiments.online_meeting', ['title' => 'Online Meeting Tool']);
	}

}
