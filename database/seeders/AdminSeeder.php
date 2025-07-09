<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'admin',
            'email' => 'admin@admin',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'role_id' => 1,
            'descricao' => 'Administrador',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
