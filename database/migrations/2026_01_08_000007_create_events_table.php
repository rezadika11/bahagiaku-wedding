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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');

            $table->enum('event_type', ['akad', 'resepsi', 'unduh_mantu', 'other']);
            $table->string('event_name');

            $table->date('event_date');
            $table->time('event_time_start');
            $table->time('event_time_end')->nullable();
            $table->string('timezone', 10)->default('WIB');

            $table->string('venue_name');
            $table->text('venue_address');
            $table->text('venue_map_url')->nullable();
            $table->decimal('venue_latitude', 10, 8)->nullable();
            $table->decimal('venue_longitude', 11, 8)->nullable();

            $table->string('dress_code')->nullable();
            $table->text('notes')->nullable();
            $table->integer('event_order')->default(0);

            $table->timestamps();

            $table->index(['invitation_id', 'event_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
