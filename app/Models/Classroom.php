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

    // Calcule la moyenne de la classe
    public function classroomAverage()
    {
        $studentIds = $this->students()->pluck('id');
        $average = \App\Models\Grade::whereIn('student_id', $studentIds)->avg('score');
        return $average ? round($average, 2) : 'N/A';
    }
}
