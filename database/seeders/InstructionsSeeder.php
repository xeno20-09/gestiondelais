<?php

namespace Database\Seeders;

use App\Models\Instruction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructions = [

            [
                'nom' => 'Paiement de consignation',
                'delais' => '15'
            ],
            [
                'nom' => 'Production de mémoire ampliatif',
                'delais' => '60'
            ],
            [
                'nom' => 'Mise en demeure de produire le mémoire ampliatif',
                'delais' => '30'
            ],
            [
                'nom' => 'Constitution d\'avocats',
                'delais' => '2'
            ],
            [
                'nom' => 'Communication des noms des conseils',
                'delais' => '2'
            ],
            [
                'nom' => 'Communication des conclusions du Parquet aux parties',
                'delais' => '30'
            ],
            [
                'nom' => 'Production des conclusions du Parquet',
                'delais' => '10'
            ],

        ];
        foreach ($instructions as $instruction) {
            Instruction::create($instruction);
        }
    }
}
