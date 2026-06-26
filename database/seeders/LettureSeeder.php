<?php

namespace Database\Seeders;

use App\Models\Anagrafica;
use App\Models\Lettura;
use App\Models\UnitaMisura;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class LettureSeeder extends Seeder
{


    /**
     * Configurazione condominio: 6 appartamenti, 2 piani + piano terra.
     * Ogni riga: numero persone nell'appartamento.
     */
    private const APPARTAMENTI = [
        ['piano' => 'terra', 'persone' => 2],
        ['piano' => 'terra', 'persone' => 2],
        ['piano' => 1, 'persone' => 1],
        ['piano' => 1, 'persone' => 3],
        ['piano' => 2, 'persone' => 4],
        ['piano' => 2, 'persone' => 4],
    ];

    private const ANNI = 10;
    private const SUPERFICIE_MQ = 80;


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $idLuce = UnitaMisura::where('tipo', 'luce')->value('id');
        $idAcqua = UnitaMisura::where('tipo', 'acqua')->value('id');

        if (!$idLuce || !$idAcqua) {
            $this->command->error('Unita di misura "luce" o "acqua" non trovate. Esegui prima il seeder UnitaMisura.');
            return;
        }

        foreach (self::APPARTAMENTI as $appartamento) {
            $anagrafica = Anagrafica::factory()->create();

            $this->generaLettureUtenza($anagrafica->id, $idLuce, $appartamento['persone'], 'luce');
            $this->generaLettureUtenza($anagrafica->id, $idAcqua, $appartamento['persone'], 'acqua');
        }
    }

    /**
     * Genera 20 letture cumulative (10 anni x 2 stagioni) per una singola utenza.
     */
    private function generaLettureUtenza(int $anagraficaId, int $unitaMisuraId, int $persone, string $tipo): void
    {
        $contatore = $this->valoreInizialeContatore($tipo);
        $annoCorrente = Carbon::now()->subYears(self::ANNI)->year;

        for ($anno = 0; $anno < self::ANNI; $anno++) {
            foreach (['inverno', 'estate'] as $stagione) {
                $consumo = $this->calcolaConsumoSemestre($tipo, $stagione, $persone);
                $contatore += $consumo;

                Lettura::factory()->create([
                    'anagrafica_id' => $anagraficaId,
                    'unita_misura_id' => $unitaMisuraId,
                    'valore' => round($contatore, 2),
                    'data_lettura' => $this->dataLettura($annoCorrente + $anno, $stagione),
                ]);
            }
        }
    }

    private function valoreInizialeContatore(string $tipo): float
    {
        return $tipo === 'luce'
            ? fake()->randomFloat(2, 500, 2000)   // kWh accumulati storici
            : fake()->randomFloat(2, 100, 500);    // mc accumulati storici
    }

    /**
     * Consumo del semestre in base a tipo utenza, stagione e numero persone.
     * Include una piccola variazione casuale per realismo.
     */
    private function calcolaConsumoSemestre(string $tipo, string $stagione, int $persone): float
    {
        $baseProPersona = $tipo === 'luce' ? 150 : 25; // kWh o mc a persona, per semestre

        $moltiplicatoreStagionale = $this->moltiplicatoreStagionale($tipo, $stagione);

        $variazioneCasuale = fake()->randomFloat(2, 0.9, 1.1); // +-10%

        return $baseProPersona * $persone * $moltiplicatoreStagionale * $variazioneCasuale;
    }

    private function moltiplicatoreStagionale(string $tipo, string $stagione): float
    {
        if ($tipo === 'luce') {
            // Inverno: più illuminazione/riscaldamento elettrico
            return $stagione === 'inverno' ? 1.4 : 0.8;
        }

        // Acqua: leggero aumento in estate (irrigazione, doccia, ecc.)
        return $stagione === 'estate' ? 1.15 : 0.95;
    }

    private function dataLettura(int $anno, string $stagione): Carbon
    {
        return $stagione === 'inverno'
            ? Carbon::create($anno, 1, 31)
            : Carbon::create($anno, 7, 31);
    }
}
