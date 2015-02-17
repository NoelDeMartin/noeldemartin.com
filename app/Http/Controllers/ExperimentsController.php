<?php namespace App\Http\Controllers;

use View;

class ExperimentsController extends Controller {

	function freedomCalculator() {
		return View::make('experiments.freedom_calculator', ['title' => 'Freedom Calculator']);
	}

}
