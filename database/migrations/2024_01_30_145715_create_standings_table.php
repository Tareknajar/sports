<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->integer('win');
            $table->integer('lose');
            $table->integer('draw');
            $table->integer('for_him');
            $table->integer('attic');
            $table->integer('+/-');
            $table->integer('point');
            $table->integer('play');
            $table->unsignedBigInteger('Clubs_id');
            $table->foreign('Clubs_id')->on('Clubs')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('seasons_id');
            $table->foreign('seasons_id')->on('seasones')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('standings');
    }
};
