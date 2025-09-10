<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('label_user_albums', function (Blueprint $table) {
            $table->id()->primary();
            $table->unsignedBigInteger('labelId');
            $table->foreign('labelId')
                  ->references('id')->on('labels')->cascadeOnDelete();
            $table->unsignedBigInteger('userAlbumId');
            $table->foreign('userAlbumId')
                ->references('id')->on('user_albums')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('labels');
        Schema::dropIfExists('label_user_albums');
    }
};
