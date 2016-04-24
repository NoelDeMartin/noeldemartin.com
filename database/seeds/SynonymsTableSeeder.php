<?php

use Illuminate\Database\Seeder;

class SynonymsTableSeeder extends Seeder {

	public function run()
	{
		$thesaurus = json_decode(file_get_contents(storage_path('experiments/thesaurus.json')));
		foreach($thesaurus as $word => $synonyms) {
			if (DB::table('synonyms')->where('word', $word)->count() == 0) {
				DB::table('synonyms')->insert(['word' => $word, 'synonyms' => json_encode($synonyms)]);
			}
		}
	}

}