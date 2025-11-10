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
        Schema::create('fines', function (Blueprint $table) {
            $table->increments('fine_id');
            
            // Foreign Keys (Defined upfront)
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('borrowing_id')->nullable(); // Can be null if fine is not tied to a specific borrow

            // Fine Details
            $table->decimal('fine_amount', 10, 2);
            $table->string('fine_reason', 255)->nullable();
            
            // Custom ENUM type for payment status
            $table->enum('payment_status', ['unpaid', 'paid', 'waived'])->default('unpaid');
            
            // Timestamps and Flags
            $table->timestamp('created_at')->useCurrent();
            $table->boolean('is_deleted')->default(0);

            // --- Foreign Key Constraints ---
            
            // FK to users table
            $table->foreign('user_id')
                  ->references('user_id')->on('users')
                  ->onDelete('CASCADE');

            // FK to borrowing_records table
            $table->foreign('borrowing_id')
                  ->references('borrowing_id')->on('borrowing_records')
                  ->onDelete('SET NULL'); // If a borrowing record is deleted, the fine record remains, but the FK is cleared.

            // --- Custom Index ---
            
            $table->index('payment_status', 'idx_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
