<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasicSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('is_admin');
            $table->boolean('is_reviewer');
            $table->timestamps();
        });
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('tag')->unique();
            $table->longText('text_markdown');
            $table->longText('text_html');
            $table->integer('author_id');
            $table->timestamp('published_at');
            $table->timestamps();
        });
        Schema::create('invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token')->unique();
            $table->string('email')->unique();
            $table->boolean('used');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('posts');
        Schema::drop('invitations');
    }
}
