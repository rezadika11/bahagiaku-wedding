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
        Schema::create('rsvps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');
            $table->foreignId('guest_id')->nullable()->constrained()->onDelete('set null');

            $table->string('name');
            $table->string('phone', 20)->nullable();

            $table->enum('attendance', ['hadir', 'tidak_hadir', 'ragu']);
            $table->integer('number_of_guests')->default(1);

            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            $table->index(['invitation_id', 'attendance']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rsvps');
    }
};
