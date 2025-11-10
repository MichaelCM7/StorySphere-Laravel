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
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('reservation_id');
            
            // Foreign Keys (Defined upfront)
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('book_id');

            // Reservation Details
            $table->timestamp('reservation_date')->useCurrent();
            $table->timestamp('expiry_date')->nullable();
            
            // Custom ENUM type for status
            $table->enum('status', ['active', 'fulfilled', 'cancelled', 'expired'])->default('active');
            
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

            // --- Custom Index ---
            
            $table->index('status', 'idx_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
