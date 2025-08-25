<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('side_songs', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('order');
            $table->unsignedBigInteger('sideId');
            $table->foreign('sideId')
                  ->references('id')->on('sides')->restrictOnDelete();
            $table->unsignedBigInteger('songId');
            $table->foreign('songId')
                ->references('id')->on('songs')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('side_songs');
    }
};
