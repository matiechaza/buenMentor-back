<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
final class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mentor_id' => Mentor::factory(),
            'user_id' => User::factory(),
            'day' => now(),
            'start_time' => now()->subHour()->format('H:i'),
            'end_time' => now()->format('H:i'),
            'amount' => fake()->numberBetween(1000, 5000),
            'status' => 'pending',
            'payment_status' => 'pending',
        ];
    }
}
