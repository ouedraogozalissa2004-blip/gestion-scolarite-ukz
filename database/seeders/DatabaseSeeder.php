<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Création des comptes utilisateurs de l'UKZ
        User::create([
            'name' => 'Gestionnaire UKZ',
            'email' => 'gestion@ukz.bf',
            'password' => Hash::make('password'),
            'role' => 'gestionnaire',
        ]);

        User::create([
            'name' => 'Enseignant UKZ',
            'email' => 'prof@ukz.bf',
            'password' => Hash::make('password'),
            'role' => 'enseignant',
        ]);

        // 2. Appel des seeders structurels et de génération de données scolaires
        $this->call([
            ClassroomSeeder::class, // Génère les classes (CP1 à CM2)
            SubjectSeeder::class,   // Génère les matières
            StudentSeeder::class,   // Génère les élèves, les notes et les paiements
        ]);
    }
}
