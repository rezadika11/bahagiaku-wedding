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
        Schema::create('gifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');

            $table->enum('gift_type', ['bank', 'ewallet', 'address']);
            $table->string('label', 100)->nullable();

            // Bank Transfer
            $table->string('bank_name', 100)->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('account_name')->nullable();

            // E-Wallet
            $table->string('ewallet_type', 50)->nullable();
            $table->string('ewallet_number', 50)->nullable();

            // Address
            $table->text('address')->nullable();

            $table->string('qr_code_url')->nullable();
            $table->integer('gift_order')->default(0);

            $table->timestamps();

            $table->index(['invitation_id', 'gift_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gifts');
    }
};
