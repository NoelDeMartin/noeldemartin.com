<?php

use Illuminate\Database\Migrations\Migration;

// This migration has been run on mysql cli instead, for more info:
// https://stackoverflow.com/questions/49427317/why-running-laravel-doctrine-raw-database-queries-is-not-the-same-as-using-mys

class UpdateTextCollation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::unprepared('ALTER TABLE posts MODIFY COLUMN text_markdown LONGTEXT COLLATE utf8mb4_unicode_ci');
        // DB::unprepared('ALTER TABLE posts MODIFY COLUMN text_html LONGTEXT COLLATE utf8mb4_unicode_ci');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::unprepared('ALTER TABLE posts MODIFY COLUMN text_markdown LONGTEXT COLLATE utf8_unicode_ci');
        // DB::unprepared('ALTER TABLE posts MODIFY COLUMN text_html LONGTEXT COLLATE utf8_unicode_ci');
    }
}
