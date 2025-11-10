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
            $table->increments('book_id');
            $table->string('isbn', 13)->nullable()->unique();
            $table->string('google_books_id', 50)->nullable();
            $table->string('title', 255);
            $table->string('publisher', 100)->nullable();
            $table->date('published_date')->nullable();
            $table->integer('page_count')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_image_url', 500)->nullable();
            $table->integer('total_copies')->default(1);
            $table->integer('available_copies')->default(1);
            $table->string('shelf_location', 50)->nullable();
            $table->enum('book_condition', ['excellent', 'good', 'fair', 'poor'])->default('good');
            $table->string('language', 10)->default('en');
            $table->boolean('is_deleted')->default(0);

            // FK to authors table
            $table->unsignedInteger('author_id')->nullable();
            $table->foreign('author_id')->references('author_id')->on('authors')->onDelete('SET NULL');

            // FK to categories table
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('SET NULL');
            
            // Custom Indexes
            $table->index('title', 'idx_title');
            $table->index(['category_id', 'available_copies'], 'idx_book_category_available');
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
