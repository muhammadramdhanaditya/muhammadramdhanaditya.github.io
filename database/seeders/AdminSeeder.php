<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'fatusuzli@gmail.com'],
            [
                'name' => 'Admin Utama',
                'email' => 'fatusuzli@gmail.com',
                'password' => Hash::make('iniadmin123'),
                'role' => 'admin',
                'phone' => '087810111815',
            ]
        );
    }
}
