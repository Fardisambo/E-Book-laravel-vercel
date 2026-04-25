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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama metode (BCA, BRI, E-Wallet, dll)
            $table->string('type'); // bank, e-wallet, cash
            $table->text('description')->nullable();
            $table->string('account_number')->nullable(); // Nomor rekening/nomor akun
            $table->string('account_holder')->nullable(); // Nama pemilik akun
            $table->string('icon_url')->nullable(); // URL icon/logo
            $table->decimal('fee_percentage', 5, 2)->default(0); // Biaya persentase
            $table->decimal('fee_fixed', 10, 2)->default(0); // Biaya tetap
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
