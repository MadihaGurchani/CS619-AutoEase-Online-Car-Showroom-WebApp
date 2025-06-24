<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'number' => '1234567890',
            'address' => '123 Main St',
            'city' => 'Anytown',
            'guarantor_name' => 'John Doe',
            'guarantor_phone' => '9876543210',
            'guarantor_address' => '456 Elm St',
            'guarantor_cnic' => '1234567890123',
            'bank_name' => 'ABC Bank',
            'account_name' => 'John Doe',
            'account_number' => '1234567890',
            'branch_code' => '12345',
            
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
