<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create(
            [
                'ci' => '0000000000',
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 1
            ]
        );
        User::factory()->create(
            [
                'ci' => '0200000002',
                'name' => 'Docente User',
                'email' => 'docente@example.com',
                'role' => 2
            ],
        );
        User::factory()->create(
            [
                'ci' => '0200000003',
                'name' => 'Estudiante User',
                'email' => 'estudiante@example.com',
                'role' => 3
            ]
        );

        $this->call([
            TemplateSeeder::class,
            PlanCuentasSeeder::class,
            // Otros seeders...
        ]);
    }
}
