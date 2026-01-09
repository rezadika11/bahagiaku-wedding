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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('theme_id')->constrained()->onDelete('restrict');
            $table->uuid('created_by');

            // URL Undangan
            $table->string('slug')->unique();

            // Info Mempelai Pria
            $table->string('groom_name');
            $table->string('groom_fullname')->nullable();
            $table->string('groom_father')->nullable();
            $table->string('groom_mother')->nullable();
            $table->string('groom_photo')->nullable();
            $table->string('groom_instagram')->nullable();
            $table->string('groom_child_order', 50)->nullable();

            // Info Mempelai Wanita
            $table->string('bride_name');
            $table->string('bride_fullname')->nullable();
            $table->string('bride_father')->nullable();
            $table->string('bride_mother')->nullable();
            $table->string('bride_photo')->nullable();
            $table->string('bride_instagram')->nullable();
            $table->string('bride_child_order', 50)->nullable();

            // Tanggal
            $table->date('wedding_date');

            // Quote/Ayat
            $table->text('quote_text')->nullable();
            $table->string('quote_source')->nullable();

            // Status
            $table->enum('status', ['draft', 'published', 'expired'])->default('draft');
            $table->boolean('is_active')->default(true);

            // Analytics
            $table->integer('view_count')->default(0);

            // Meta untuk SEO/Share
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image')->nullable();

            $table->timestamp('published_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index('slug');
            $table->index('status');
            $table->index('wedding_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
