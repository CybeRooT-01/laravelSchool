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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->integer('note');
            $table->unsignedBigInteger('inscription_id');
            $table->unsignedBigInteger('assosCinq_id');
            $table->foreign('assosCinq_id')->references('id')->on('assos_cinqs')->onDelete('cascade');
            $table->foreign('inscription_id')->references('id')->on('inscriptions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
