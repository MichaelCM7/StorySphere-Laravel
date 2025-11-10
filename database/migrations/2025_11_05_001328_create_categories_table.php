<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Queue\Console\TableCommand;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
           $table->increments('category_id');
            
            // Core Data
            $table->string('category_name', 50)->unique();
            $table->text('description')->nullable();
            
            // Soft Delete flag
            $table->boolean('is_deleted')->default(0);

            // Custom Index
            $table->index('category_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
