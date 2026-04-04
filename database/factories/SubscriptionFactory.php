<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Paiement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subscription>
 */
class SubscriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'duration'        => fake()->numberBetween(1, 8760),
            'price'           => fake()->numberBetween(1000, 10000000),
            'hours'           => fake()->numberBetween(1, 24),
            'start_date'      => fake()->date(),
            'daily_frequency' => fake()->numberBetween(1, 24),
            'type'            => fake()->randomElement(['Beginner', 'Professional', 'Premium']),
            'user_id'         => User::pluck('id')->isNotEmpty()
                                    ? User::pluck('id')->random()
                                    : User::factory(),
            //'payment_id'      => Paiement::pluck('id')->isNotEmpty()
                                   // ? Paiement::pluck('id')->random()
                                   // : Paiement::factory(),
        ];
    }
}