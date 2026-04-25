<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->enum('plan', ['monthly', 'yearly'])->unique();
            $table->decimal('price', 10, 2)->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('subscription_plans')->insert([
            [
                'plan' => 'monthly',
                'price' => 50000,
                'description' => 'Akses membaca semua buku tanpa batas selama 1 bulan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'plan' => 'yearly',
                'price' => 500000,
                'description' => 'Akses membaca semua buku tanpa batas selama 1 tahun dengan harga hemat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};

