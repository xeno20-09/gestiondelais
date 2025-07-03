<?php

namespace Database\Seeders;

use App\Models\Objet;
use Illuminate\Database\Seeder;

class ObjetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objets = [
            [
                'nom' => 'Recours en annulation',
            ],
            [
                'nom' => 'Requêtes au fin de récusation',
            ],
            [
                'nom' => 'Requêtes aux fins de renvoi pour cause de suspicion légitime',
            ],
            [
                'nom' => 'Requêtes aux fins de désignation d\'instruction',
            ],
            [
                'nom' => 'Recours en cassation',
            ],
            [
                'nom' => 'Recours de plein contentieux',
            ],
            [
                'nom' => 'Reexamen',
            ],
            [
                'nom' => 'Recours en rectification d\'erreurs matérielles',
            ],
            [
                'nom' => 'Recours en reconstitution de carrière',
            ],
            [
                'nom' => 'Rabais d\'arrêt',
            ],
            [
                'nom' => 'Recours en interprétation',
            ],
            [
                'nom' => 'Recours en contrôle juridictionnel de la décentralisation',
            ]
        ];

        foreach ($objets as $objet) {
            Objet::create($objet);
        }
    }
}
