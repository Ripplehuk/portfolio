<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_degrees', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('field')->nullable();
            $table->string('institution')->nullable();
            $table->string('country')->nullable();
            $table->integer('year')->nullable();
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_degrees');
    }
};
