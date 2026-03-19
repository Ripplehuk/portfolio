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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('authors')->nullable();
            $table->string('journal')->nullable();
            $table->year('publication_year')->nullable();
            $table->longText('abstract')->nullable();
            $table->text('keywords')->nullable();
            $table->string('doi')->nullable();
            $table->string('link')->nullable();
            $table->string('pdf_file')->nullable();
            $table->string('cover_image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
