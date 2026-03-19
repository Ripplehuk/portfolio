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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('position')->nullable();
            $table->string('organization')->nullable();
            $table->text('short_bio')->nullable();
            $table->longText('full_bio')->nullable();
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('telegram')->nullable();
            $table->string('google_scholar')->nullable();
            $table->string('orcid')->nullable();
            $table->string('scopus')->nullable();
            $table->string('researchgate')->nullable();
            $table->string('cv_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
