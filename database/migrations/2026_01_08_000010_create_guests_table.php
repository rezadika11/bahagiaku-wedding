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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');

            $table->string('name');
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable();

            $table->string('guest_code', 50)->unique();
            $table->enum('guest_group', [
                'keluarga_pria',
                'keluarga_wanita',
                'teman',
                'rekan_kerja',
                'tetangga',
                'lainnya'
            ])->default('lainnya');
            $table->integer('quota')->default(1);

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['invitation_id', 'guest_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
