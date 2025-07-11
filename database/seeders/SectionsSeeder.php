<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sections = [
            [
                'nom_section' => 'SECTION 1',
                'code_section' => '1',
                'structure_id' => 1,
            ],
            [
                'nom_section' => 'SECTION 2',
                'code_section' => '2',
                'structure_id' => 1,
            ],
            [
                'nom_section' => 'SECTION 3',
                'code_section' => '3',
                'structure_id' => 1,
            ],
            [
                'nom_section' => 'PCA',
                'code_section' => 'PCA',
                'structure_id' => 1,
            ],
            [
                'nom_section' => 'SECTION DES AFFAIRES DE DROIT PENAL ET DES PROCEDURES SPECIALES PENALES',
                'code_section' => 'P',
                'structure_id' => 2,
            ],
            [
                'nom_section' => 'SECTION DES AFFAIRES CIVILES COMMERCIALES ET SOCIALES',
                'code_section' => 'CM',
                'structure_id' => 2,
            ],
            [
                'nom_section' => 'SECTION DES AFFAIRES DU DROIT FONCIER',
                'code_section' => 'DF',
                'structure_id' => 2,
            ],
            [
                'nom_section' => 'PCJ',
                'code_section' => 'PCJ',
                'structure_id' => 2,
            ],
        ];
        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
