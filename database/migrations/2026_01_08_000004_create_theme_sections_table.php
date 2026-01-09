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
        Schema::create('theme_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('theme_id')->constrained()->onDelete('cascade');

            $table->string('section_type', 50);
            $table->string('section_name', 100);
            $table->string('component_name', 100);

            $table->integer('section_order')->default(0);
            $table->boolean('is_enabled')->default(true);
            $table->json('default_settings')->nullable();

            $table->timestamps();

            $table->index(['theme_id', 'section_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_sections');
    }
};
