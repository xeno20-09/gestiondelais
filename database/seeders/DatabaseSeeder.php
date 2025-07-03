<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\ObjetsSeeder;
use Database\Seeders\StructuresSeeder;
use Database\Seeders\SectionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /* 
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
        $this->call([
            InstructionsSeeder::class,
            StructuresSeeder::class,
            SectionsSeeder::class,
            UserRoleSeeder::class,
            UserTitreSeeder::class,
            UsersSeeder::class,
            ObjetsSeeder::class,

        ]);
    }
}
