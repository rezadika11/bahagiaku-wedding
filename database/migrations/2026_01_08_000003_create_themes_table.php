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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Preview
            $table->string('thumbnail')->nullable();
            $table->string('preview_url')->nullable();

            // Kategorisasi
            $table->enum('category', ['wedding', 'engagement', 'akikah', 'birthday', 'event'])->default('wedding');
            $table->string('style', 100)->nullable();
            $table->string('color_family', 50)->nullable();

            // Styling (JSON)
            $table->json('color_scheme')->nullable();
            $table->json('fonts')->nullable();

            // Layout
            $table->string('layout_type', 50)->default('fullpage-scroll');

            // Status
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Indexes
            $table->index('slug');
            $table->index('category');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
