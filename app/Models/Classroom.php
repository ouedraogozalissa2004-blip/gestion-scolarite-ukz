<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    protected $fillable = ['name', 'tuition_fee'];

    // Une classe possède plusieurs élèves
    public function students(): HasMany
    {
        return $this->hasMany(\App\Models\Student::class);
    }

    // Une classe possède plusieurs matières spécifiques
    public function subjects(): HasMany
    {
        return $this->hasMany(\App\Models\Subject::class);
    }

    // Calcule la moyenne de la classe ramenée sur 10
    public function classroomAverage()
    {
        // 1. Récupérer les identifiants de tous les élèves de cette classe
        $studentIds = $this->students()->pluck('id');
        
        // 2. Calculer la moyenne brute de toutes leurs notes
        $average = \App\Models\Grade::whereIn('student_id', $studentIds)->avg('score');
        
        if (!$average) {
            return 'N/A';
        }

        // 3. Adapter le calcul pour que la moyenne finale de la classe soit sur 10
        if (in_array($this->name, ['CM1', 'CM2'])) {
            // Pour le CM1/CM2 (notes sur 20), on divise par 2 pour la ramener sur 10
            $moyenneSurDix = $average / 2;
            return round($moyenneSurDix, 2) . ' / 10';
        }

        // Pour CP1, CP2, CE1, CE2 (déjà sur 10), on l'affiche directement
        return round($average, 2) . ' / 10';
    }
}
