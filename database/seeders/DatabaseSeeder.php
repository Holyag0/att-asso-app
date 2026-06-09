<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Atendente',
            'email' => 'atendente@admin.com',
            'role' => 'atendente',
        ]);
    }
}
