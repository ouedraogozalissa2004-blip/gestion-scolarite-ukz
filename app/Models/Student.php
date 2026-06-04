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
        // 1. Calculer la moyenne brute des notes de l'élève
        $average = $this->grades()->avg('score');
        
        if (!$average) {
            return 'N/A';
        }

        // 2. Récupérer le nom de la classe (ex: CP1, CM2)
        $className = $this->classroom->name ?? '';

        // 3. Adapter le calcul pour que la moyenne finale soit toujours sur 10
        if (in_array($className, ['CP1', 'CP2', 'CE1', 'CE2'])) {
            // Déjà noté sur 10, on garde la valeur brute
            return round($average, 2) . ' / 10';
        } else {
            // Noté sur 20 (CM1, CM2), on divise par 2 pour ramener la moyenne générale sur 10
            $moyenneSurDix = $average / 2;
            return round($moyenneSurDix, 2) . ' / 10';
        }
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
