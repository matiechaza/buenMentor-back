<?php

namespace Database\Seeders;

use App\Models\Availability;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        Mentor::factory()
            ->for(User::factory()->state([
                'name' => 'Test Mentor',
                'email' => 'testmentor@example.com',
                'password' => bcrypt('password'),
            ]))
            ->has(Availability::factory()->count(5))
            ->create();
    }
}
