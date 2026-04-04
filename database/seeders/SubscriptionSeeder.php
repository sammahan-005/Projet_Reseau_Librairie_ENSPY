<?php

namespace Database\Seeders;

use App\Models\subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creation des abonnements...');
        Subscription::factory(50)->create();
        $this->command->info('Abonnements créés avec succès!');
    }
}
