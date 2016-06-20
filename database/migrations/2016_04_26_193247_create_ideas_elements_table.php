<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeasElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas_elements', function (Blueprint $table) {
          $table->integer('IDIdea');
          $table->string('character');
          $table->string('place');
          $table->string('ressource');
          $table->string('quest');
          $table->string('warning');
          $table->string('treasure');
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
        Schema::drop('ideas_elements');
    }
}
