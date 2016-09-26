<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('serial')->unique();

            $table->string('first');
            $table->string('second');

            $table->string('list_url');
            $table->string('regex_url_area');
            $table->string('regex_url_list');

            $table->text('regex_article');
            $table->text('regex_title');
            $table->text('regex_date');
            $table->text('regex_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rules');
    }
}
