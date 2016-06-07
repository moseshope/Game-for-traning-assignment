<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('elements', function (Blueprint $table) {
          $table->increments('id');
          $table->string('category');
          $table->string('label');
          $table->integer('difficulty');
          $table->dropColumn(['character_1', 'character_2', 'location_1', 'location_2', 'power_1', 'power_2', 'goal_1', 'goal_2', 'warning_1', 'warning_2', 'prize_1', 'prize_2']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('elements', function (Blueprint $table) {
            //
        });
    }
}
