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
        Schema::create('ratings', function (Blueprint $table) {
            $table->unsignedInteger('book_id');
            $table->primary('book_id');
            $table->decimal('rating', 2, 1)->nullable();
            $table->integer('rating_count')->default(0);
            $table->boolean('is_deleted')->default(0);
            $table->foreign('book_id')
                  ->references('book_id')->on('books')
                  ->onDelete('CASCADE');
            $table->index('rating', 'idx_rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
