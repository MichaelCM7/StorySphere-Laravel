<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();
        // reader
        $reader = new Role();
        $reader->role_name = "reader";
        $reader->is_deleted = 0;
        $reader->save();

        // librarian
        $librarian = new Role();
        $librarian->role_name = "librarian";
        $librarian->is_deleted = 0;
        $librarian->save();

        // admin
        $admin = new Role();
        $admin->role_name = "admin";
        $admin->is_deleted = 0;
        $admin->save();
    }
}
