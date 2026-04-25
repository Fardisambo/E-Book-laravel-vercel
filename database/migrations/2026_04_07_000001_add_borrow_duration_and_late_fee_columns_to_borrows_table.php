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
        Schema::table('borrows', function (Blueprint $table) {
            $table->integer('borrow_days')->nullable()->after('due_date');
            $table->integer('late_days')->nullable()->default(0)->after('borrow_days');
            $table->integer('late_fee')->nullable()->default(0)->after('late_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrows', function (Blueprint $table) {
            $table->dropColumn(['borrow_days', 'late_days', 'late_fee']);
        });
    }
};
