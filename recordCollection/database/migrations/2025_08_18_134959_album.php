<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
            $table->unsignedBigInteger('genreId');
            $table->foreign('genreId')
                  ->references('id')->on('genres')->restrictOnDelete();
            $table->unsignedBigInteger('artistId');
            $table->foreign('artistId')
                ->references('id')->on('artists')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
