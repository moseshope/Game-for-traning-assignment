<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->increments('idIdea');
            $table->timestamps();
            $table->string('idUser');
            $table->string('idChallenge');
            $table->string('idElement');
            $table->string('title');
            $table->string('content');
        });

        Schema::create('ideas_elements', function (Blueprint $table) {
          $table->integer('idIdea');
          $table->integer('idElement');
        });

        Schema::create('elements', function (Blueprint $table) {
          $table->increments('idElement');
          $table->integer('idType');
          $table->integer('idChallenge');
        })
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ideas');
    }
}
