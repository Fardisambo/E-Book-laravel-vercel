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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('author');
            $table->text('description')->nullable();
            $table->string('isbn')->nullable()->unique();
            $table->integer('published_year')->nullable();
            $table->string('publisher')->nullable();
            $table->string('language')->default('id');
            $table->integer('total_pages')->nullable();
            $table->string('cover_url')->nullable();
            $table->string('file_url')->nullable(); // URL untuk file PDF/EPUB
            $table->string('file_path')->nullable(); // Path lokal untuk file
            $table->string('file_type')->nullable(); // pdf, epub, etc
            $table->integer('file_size')->nullable(); // dalam bytes
            $table->integer('views')->default(0);
            $table->integer('downloads')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
