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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('paymentable_type'); // 'App\Models\Purchase' or 'App\Models\Subscription'
            $table->unsignedBigInteger('paymentable_id');
            $table->decimal('amount', 10, 2);
            $table->enum('method', ['qr_code', 'bank_transfer', 'credit_card', 'e_wallet'])->default('qr_code');
            $table->string('qr_code')->nullable();
            $table->string('transaction_id')->unique()->nullable();
            $table->enum('status', ['pending', 'completed', 'failed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            
            $table->index(['paymentable_type', 'paymentable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
