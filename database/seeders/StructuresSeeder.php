<?php

namespace Database\Seeders;

use App\Models\Structure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StructuresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $structures = [
            [
                'nom_structure' => 'Chambre Administrative',
                'code_structure' => 'CA',
                'email' => 'chambreadministratifcoursupreme@exemple.com',
            ],
            [
                'nom_structure' => 'Chambre Judiciaire',
                'code_structure' => 'CJ',
                'email' => 'chambrejudiciairecoursupreme@exemple.com',
            ],
        ];
        foreach ($structures as $structure) {
            Structure::create($structure);
        }
    }
}
