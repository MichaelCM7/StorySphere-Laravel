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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('first_name', 50)->nullable(false);
            $table->string('last_name', 50)->nullable(false);
            $table->string('combined_username', 100);
            DB::statement('ALTER TABLE users ADD `combined_username` VARCHAR(100) GENERATED ALWAYS AS (CONCAT(`first_name`, " ", `last_name`)) STORED');
            $table->string('email', 100)->unique()->nullable(false);
            $table->string('password_hash', 255)->nullable(false);
            $table->string('phone_number', 20)->nullable();
            $table->unsignedInteger('role_id')->default(3);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->boolean('is_deleted')->default(0);
            $table->index('role_id', 'idx_role_id');
            $table->index('combined_username', 'idx_full_name');
            $table->foreign('role_id', 'users_ibfk_1')
                  ->references('role_id')->on('roles')
                  ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
