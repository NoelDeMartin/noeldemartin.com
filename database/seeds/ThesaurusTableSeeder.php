<?php

use Illuminate\Database\Seeder;

class ThesaurusTableSeeder extends Seeder {

	public function run()
	{
		$thesaurus = fopen(storage_path('experiments/synonymizer-thesaurus/th_en_US_new.dat'), "r");
		if ($thesaurus) {
			// Ignore first line
			fgets($thesaurus);

			// Parse File
			while (($wordLine = fgets($thesaurus)) !== false) {
				$info = explode('|', $wordLine);
				$word = $info[0];
				$data = [];
				$meaningsCount = intval($info[1]);

				// Parse word data
				for ($i=0; $i < $meaningsCount; $i++) {
					$meaningLine = fgets($thesaurus);
					$info = explode('|', $meaningLine);
					$type = substr(array_shift($info), 1, -1);
					$data[] = ['type'      => $type,
								'synonyms' => array_map(function($word) {
									return trim(preg_replace('/\(.+?\)/', '', $word));
								}, $info)];
				}
				DB::table('thesaurus')->insert([
					'word' => $word,
					'data' => json_encode($data)
				]);
			}
			if (!feof($thesaurus)) {
				echo "Error: unexpected fgets() fail\n";
			}
			fclose($thesaurus);
		}
	}

}