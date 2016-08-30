<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('serial')->unique();
            $table->string('url');
            $table->string('url_area');
            $table->string('url_rule');
            $table->string('content_area');
            $table->string('title_rule');
            $table->string('date_rule');
            $table->string('article_rule');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('update_rules');
    }
}
