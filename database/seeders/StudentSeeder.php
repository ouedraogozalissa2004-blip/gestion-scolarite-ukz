<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Générer 40 élèves fictifs
        Student::factory(40)->create()->each(function ($student) {
            
            // 1. Récupérer uniquement les matières de la classe de l'élève
            $subjects = Subject::where('classroom_id', $student->classroom_id)->get();

            // 2. Simuler entre 1 et 2 paiements (acomptes) de scolarité par élève
            $nombrePaiements = rand(1, 2);
            for ($i = 0; $i < $nombrePaiements; $i++) {
                Payment::create([
                    'student_id' => $student->id,
                    'amount_paid' => rand(15000, 25000), 
                    'payment_date' => now()->subDays(rand(1, 30)), 
                ]);
            }

            // 3. Déterminer le barème de notation selon la classe
            // Récupère le nom de la classe (ex: CP1, CM2)
            $className = $student->classroom->name ?? ''; 
            
            if (in_array($className, ['CP1', 'CP2', 'CE1', 'CE2'])) {
                $maxScore = 10; // Note sur 10 pour le cours préparatoire et élémentaire
                $minScore = 5;
            } else {
                $maxScore = 20; // Note sur 20 pour le cours moyen (CM1, CM2)
                $minScore = 9;
            }

            // 4. Attribuer des notes réalistes selon le barème de la classe
            foreach ($subjects as $subject) {
                Grade::create([
                    'student_id' => $student->id,
                    'subject_id' => $subject->id,
                    'score' => rand($minScore, $maxScore), // Génère la bonne note selon la classe
                    'quarter' => 1,       
                ]);
            }
        });
    }
}
