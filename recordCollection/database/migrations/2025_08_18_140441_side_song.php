<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('side_song', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('sideId');
            $table->foreign('sideId')
                  ->references('id')->on('side')->restrictOnDelete();
            $table->unsignedBigInteger('songId');
            $table->foreign('songId')
                ->references('id')->on('song')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('side_song');
    }
};
