<?php

use Illuminate\Database\Migrations\Migration;

class UpdateTextCollation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::getPdo()->prepare("set session sql_mode='NO_ENGINE_SUBSTITUTION'")->execute();
        DB::unprepared('ALTER TABLE posts MODIFY COLUMN text_markdown LONGTEXT COLLATE utf8mb4_unicode_ci');
        DB::unprepared('ALTER TABLE posts MODIFY COLUMN text_html LONGTEXT COLLATE utf8mb4_unicode_ci');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::getPdo()->prepare("set session sql_mode='NO_ENGINE_SUBSTITUTION'")->execute();
        DB::unprepared('ALTER TABLE posts MODIFY COLUMN text_markdown LONGTEXT COLLATE utf8_unicode_ci');
        DB::unprepared('ALTER TABLE posts MODIFY COLUMN text_html LONGTEXT COLLATE utf8_unicode_ci');
    }
}
