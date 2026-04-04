<?php

namespace Database\Seeders;

use App\Models\paiement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creation des paiements...');
        Paiement::factory(50)->create();
        $this->command->info('Paiements créés avec succès!');
    }
}
