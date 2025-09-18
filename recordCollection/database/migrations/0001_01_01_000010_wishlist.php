<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id()->primary();
            $table->uuid('userId');
            $table->foreign('userId')
                  ->references('id')->on('users')->restrictOnDelete();
            $table->unsignedBigInteger('albumId');
            $table->foreign('albumId')
                ->references('id')->on('albums')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
