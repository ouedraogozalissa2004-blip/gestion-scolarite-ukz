<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- AJOUTÉ : Import indispensable
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory; // <-- AJOUTÉ : Activation des factories

    protected $fillable = ['classroom_id', 'first_name', 'last_name', 'photo_path'];

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Classroom::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(\App\Models\Payment::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(\App\Models\Grade::class);
    }

    public function averageScore()
    {
        $average = $this->grades()->avg('score');
        return $average ? round($average, 2) : 'N/A';
    }

    public function totalPaid()
    {
        return $this->payments()->sum('amount_paid'); // <-- Note : utilise la colonne amount_paid
    }

    public function tuitionStatus()
    {
        $totalCost = $this->classroom->tuition_fee ?? 0;
        $paid = $this->totalPaid();
        
        if ($paid >= $totalCost) {
            return '<span style="color: green; font-weight: bold;">Scolarité Soldée</span>';
        }
        
        $remaining = $totalCost - $paid;
        return '<span style="color: red; font-weight: bold;">Reste : ' . number_format($remaining, 0, ',', ' ') . ' FCFA</span>';
    }
}
