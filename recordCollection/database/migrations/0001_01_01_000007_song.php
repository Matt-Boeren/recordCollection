<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
            $table->timestamps();
            $table->integer('order');
            $table->unsignedBigInteger('sideId');
            $table->foreign('sideId')
                  ->references('id')->on('sides')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
