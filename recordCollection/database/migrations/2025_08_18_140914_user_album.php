<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('user_album', function (Blueprint $table) {
            $table->id()->primary();
            $table->uuid('userId');
            $table->foreign('userId')
                  ->references('id')->on('user')->restrictOnDelete();
            $table->unsignedBigInteger('albumId');
            $table->foreign('albumId')
                ->references('id')->on('album')->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_album');
    }
};
