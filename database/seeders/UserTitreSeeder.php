<?php

namespace Database\Seeders;

use App\Models\UserTitre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTitreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titre = [
            [
                'nom' => 'SECRETAIRE',
            ],
            [
                'nom' => 'AUDITEUR',
            ],
            [
                'nom' => 'CONSEILLER',
            ],
            [
                'nom' => 'GREFFIER',
            ],
            [
                'nom' => 'PRESIDENT DE STRUCTURE',
            ],
            [
                'nom' => 'SUPER ADMIN',
            ],
        ];
        foreach ($titre as $value) {
            UserTitre::create($value);
        }
    }
}
