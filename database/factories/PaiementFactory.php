<?php

namespace Database\Factories;

use App\Models\Paiement;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Paiement>
 */
class PaiementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'amount'          => fake()->numberBetween(500, 100000000),
            'payment_method'  => fake()->randomElement([
                'carte de crédit',
                'paypal',
                'transfert bancaire',
                'orange money',
                'mtn mobile money'
            ]),
            'status'          => fake()->randomElement([
                'en attente',
                'effectué',   // correction de la faute "ffectué"
                'échoué'
            ]),
            'payment_date'    => fake()->date(),
            'subscription_id' => Subscription::pluck('id')->random()
        ];
    }
}