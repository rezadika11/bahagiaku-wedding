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
        Schema::create('guest_broadcasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guest_id')->constrained()->onDelete('cascade');
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');
            $table->uuid('sent_by');

            // WhatsApp Info
            $table->string('phone_number', 20);
            $table->text('whatsapp_url');

            // Pesan
            $table->text('message_template')->nullable();
            $table->text('message_rendered')->nullable();
            $table->text('message_encoded')->nullable();

            // Link undangan unik
            $table->text('invitation_url');

            // Status
            $table->enum('status', ['pending', 'url_generated', 'clicked', 'sent', 'opened'])->default('pending');

            // Tracking timestamps
            $table->timestamp('url_generated_at')->nullable();
            $table->timestamp('url_clicked_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('opened_at')->nullable();

            // Metadata
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();

            $table->foreign('sent_by')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index('status');
            $table->index('invitation_id');
            $table->index('guest_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_broadcasts');
    }
};
