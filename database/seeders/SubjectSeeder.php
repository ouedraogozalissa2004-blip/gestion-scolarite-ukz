<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Récupérer toutes les classes créées par le ClassroomSeeder
        $classrooms = Classroom::all();

        if ($classrooms->isEmpty()) {
            $this->command->error("Veuillez vous assurer que ClassroomSeeder est exécuté avant SubjectSeeder !");
            return;
        }

        // Liste des matières à ajouter
        $subjects = ['Calcul', 'Rédaction', 'Dictée', 'Histoire-Géographie', 'Sciences / Éveil'];

        // 2. Associer chaque matière à chaque classe existante
        foreach ($classrooms as $classroom) {
            foreach ($subjects as $name) {
                Subject::create([
                    'name' => $name,
                    'classroom_id' => $classroom->id, // Fournit la clé obligatoire demandée par la base de données
                ]);
            }
        }
    }
}
