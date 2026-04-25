<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Expand the enum to include petugas, then migrate any legacy author roles.
        DB::statement("ALTER TABLE users MODIFY role ENUM('user','admin','author','petugas') NOT NULL DEFAULT 'user'");
        DB::table('users')->where('role', 'author')->update(['role' => 'petugas']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY role ENUM('user','admin','author') NOT NULL DEFAULT 'user'");
        DB::table('users')->where('role', 'petugas')->update(['role' => 'author']);
    }
};
