<?php

namespace Database\Factories;

use App\Models\Spp;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'spp_id' => Spp::inRandomOrder()->first()?->id ?? Spp::factory(),
            'jumlah_bayar' => $this->faker->randomElement([200000, 300000, 600000]),
            'bulan' => $this->faker->monthName(),
            'status' => $this->faker->randomElement(['menunggu', 'lunas']),
        ];
    }
}
