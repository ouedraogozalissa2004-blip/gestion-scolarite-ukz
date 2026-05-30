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
        // Création du compte Gestionnaire par défaut
        User::create([
            'name' => 'Gestionnaire UKZ',
            'email' => 'gestion@ukz.bf',
            'password' => Hash::make('password'),
            'role' => 'gestionnaire',
        ]);

        // Création du compte Enseignant par défaut
        User::create([
            'name' => 'Enseignant UKZ',
            'email' => 'prof@ukz.bf',
            'password' => Hash::make('password'),
            'role' => 'enseignant',
        ]);
    }
}
