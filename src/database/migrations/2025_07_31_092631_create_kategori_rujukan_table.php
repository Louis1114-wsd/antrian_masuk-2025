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
        Schema::create('kategori_rujukan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_kategori_id');
            $table->unsignedBigInteger('to_kategori_id');
            $table->timestamps();

            $table->foreign('from_kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
            $table->foreign('to_kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_rujukan');
    }
};
