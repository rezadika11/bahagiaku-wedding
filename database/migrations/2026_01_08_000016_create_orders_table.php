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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('invitation_id')->nullable()->constrained()->onDelete('set null');
            $table->uuid('created_by');

            $table->string('order_number', 50)->unique();
            $table->string('theme_name')->nullable();

            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            $table->enum('payment_status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_proof')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index('order_number');
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
