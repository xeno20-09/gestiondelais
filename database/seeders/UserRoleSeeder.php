<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
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
                'nom' => 'PCA',
            ],
            [
                'nom' => 'PCJ',
            ],
            [
                'nom' => 'SUPER ADMIN',
            ],
        ];
        foreach ($role as $value) {
            UserRole::create($value);
        }
    }
}
