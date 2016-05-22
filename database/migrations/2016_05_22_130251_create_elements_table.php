<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->integer('IDChallenge');
            $table->string('character_1', 20);
            $table->string('character_2', 20);
            $table->string('location_1', 20);
            $table->string('location_2', 20);
            $table->string('power_1', 20);
            $table->string('power_2', 20);
            $table->string('goal_1', 20);
            $table->string('goal_2', 20);
            $table->string('warning_1', 20);
            $table->string('warning_2', 20);
            $table->string('prize_1', 20);
            $table->string('prize_2', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('elements');
    }
}
