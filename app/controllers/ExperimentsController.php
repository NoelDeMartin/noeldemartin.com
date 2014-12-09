<?php

class ExperimentsController extends BaseController {

	function freedomCalculator() {
		return View::make('experiments.freedom_calculator', ['title' => 'Freedom Calculator']);
	}

}
