<?php

namespace Database\Seeders;

use App\Models\UnitaMisura;
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

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            User::factory()->raw(['name' => 'Test User'])
        );

        $dati = [
            ['grandezza' => 'consumo energetico', 'simbolo' => 'kWh'],
            ['grandezza' => 'consumo acqua', 'simbolo' => 'm³'],
        ];

        foreach ($dati as $riga) {
            UnitaMisura::firstOrCreate(['simbolo' => $riga['simbolo']], $riga);
        }


        $this->call(LettureSeeder::class);
    }
}
