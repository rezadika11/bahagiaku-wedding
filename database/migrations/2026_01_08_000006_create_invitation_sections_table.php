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
        Schema::create('invitation_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');
            $table->foreignId('theme_section_id')->constrained()->onDelete('restrict');

            $table->integer('section_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->json('custom_settings')->nullable();

            $table->timestamps();

            $table->index(['invitation_id', 'section_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation_sections');
    }
};
