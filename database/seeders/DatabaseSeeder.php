<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'email' => 'test@admin.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}