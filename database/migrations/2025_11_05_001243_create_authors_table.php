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
        Schema::create('authors', function (Blueprint $table) {
            $table->increments('author_id');
            
            // Core Data
            $table->string('author_name', 100);
            $table->text('biography')->nullable();
            
            // Timestamps and Flags
            $table->timestamp('created_at')->useCurrent();
            $table->boolean('is_deleted')->default(0);

            // Custom Index
            $table->index('author_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
