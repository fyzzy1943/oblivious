<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimesToRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rules', function (Blueprint $table) {
            $table->unsignedInteger('update_times');
            $table->unsignedInteger('regex_times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rules', function (Blueprint $table) {
            $table->dropColumn('update_times');
            $table->dropColumn('regex_times');
        });
    }
}
