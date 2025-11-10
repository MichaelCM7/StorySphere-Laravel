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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->increments('borrowing_id');
            
            // Foreign Keys (Defined upfront)
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('book_id');
            $table->unsignedInteger('book_status_id')->default(1); // Default to Issued (1)

            // Date & Time Columns
            $table->dateTime('issue_date');
            $table->date('due_date');
            $table->date('return_date')->nullable();
            
            // Soft Delete flag
            $table->boolean('is_deleted')->default(0);

            // --- Foreign Key Constraints ---
            
            // FK to users table
            $table->foreign('user_id')
                  ->references('user_id')->on('users')
                  ->onDelete('CASCADE');

            // FK to books table
            $table->foreign('book_id')
                  ->references('book_id')->on('books')
                  ->onDelete('CASCADE');
            
            // FK to book_statuses table
            $table->foreign('book_status_id')
                  ->references('book_status_id')->on('book_statuses')
                  ->onDelete('RESTRICT');

            // --- Custom Indexes ---
            
            $table->index('due_date', 'idx_due_date');
            $table->index(['user_id', 'book_status_id'], 'idx_borrowing_user_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
