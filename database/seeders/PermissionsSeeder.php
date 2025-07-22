<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'user-list',
            'user-create',
            'user-edit',
            'user-update',
            'user-delete',

            'structure-list',
            'structure-create',
            'structure-edit',
            'structure-update',
            'structure-delete',

            'section-list',
            'section-create',
            'section-edit',
            'section-update',
            'section-delete',

            'titre-list',
            'titre-create',
            'titre-edit',
            'titre-update',
            'titre-delete',

            'role-list',
            'role-create',
            'role-edit',
            'role-update',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-update',
            'permission-delete',

            'objet-list',
            'objet-create',
            'objet-edit',
            'objet-update',
            'objet-delete',

            'recours-list',
            'recours-create',
            'recours-edit',
            'recours-update',
            'recours-delete',
            'recours-affecter',
            'recours-historique',
            'recours-detail',

            'mesure-execute',

            'recours-instruction',




            'instruction-list',
            'instruction-create',
            'instruction-edit',
            'instruction-update',
            'instruction-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // ADMIN
        $adminRole = Role::firstOrCreate(['name' => 'SUPER ADMIN']);
        $adminRole->syncPermissions([
            'user-list',
            'user-create',
            'user-edit',
            'user-update',
            'user-delete',

            'structure-list',
            'structure-create',
            'structure-edit',
            'structure-update',
            'structure-delete',

            'section-list',
            'section-create',
            'section-edit',
            'section-update',
            'section-delete',

            'titre-list',
            'titre-create',
            'titre-edit',
            'titre-update',
            'titre-delete',

            'role-list',
            'role-create',
            'role-edit',
            'role-update',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-update',
            'permission-delete',


            'objet-list',
            'recours-list',
            'instruction-list',
            'recours-historique',
            'recours-detail',

        ]);

        // SECRETAIRE
        $secretaireRole = Role::firstOrCreate(['name' => 'SECRETAIRE']);
        $secretaireRole->syncPermissions([
            'structure-list',
            'section-list',
            'objet-list',
            'objet-create',
            'objet-edit',
            'objet-update',
            'objet-delete',
            'recours-list',
            'recours-create',
            'recours-edit',
            'recours-update',
            'instruction-list',
            'recours-historique',
            'recours-detail',
        ]);

        // GREFFIER
        $greffierRole = Role::firstOrCreate(['name' => 'GREFFIER']);
        $greffierRole->syncPermissions([
            'structure-list',
            'section-list',
            'objet-list',
            'objet-create',
            'objet-edit',
            'objet-update',
            'objet-delete',
            'recours-list',
            'recours-create',
            'recours-edit',
            'recours-update',
            'recours-delete',
            'mesure-execute',
            'instruction-list',
            'recours-historique',
            'recours-detail',
        ]);



        // CONSEILLER
        $conseillerRole = Role::firstOrCreate(['name' => 'CONSEILLER']);
        $conseillerRole->syncPermissions([
            'structure-list',
            'section-list',
            'objet-list',
            'recours-list',
            'recours-instruction',
            'instruction-list',
            'instruction-create',
            'instruction-edit',
            'instruction-update',
            'instruction-delete',
            'recours-historique',
            'recours-detail',
        ]);

        // PCA
        $pcaRole = Role::firstOrCreate(['name' => 'PCA']);
        $pcaRole->syncPermissions([
            'structure-list',
            'section-list',
            'objet-list',

            'recours-list',

            'recours-affecter',
            'instruction-list',
            'recours-historique',
            'recours-detail',

        ]);

        // PCJ
        $pcjRole = Role::firstOrCreate(['name' => 'PCJ']);
        $pcjRole->syncPermissions([
            'structure-list',
            'section-list',
            'objet-list',
            'recours-list',
            'recours-affecter',
            'instruction-list',
            'recours-historique',
            'recours-detail',
        ]);
    }
}
