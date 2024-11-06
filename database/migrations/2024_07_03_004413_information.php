<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('title');
            $table->string('content');
            $table->string('image');
            $table->integer('reads')->nullable()->default(0);
            $table->enum('type',['stategy','news']);
            $table->unsignedBigInteger('statistic_id')->unique()->nullable();
            $table->foreign('statistic_id')->on('statistics')->references('id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');

    }
};
