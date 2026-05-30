<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    protected $fillable = ['name', 'classroom_id']; // Ajout de classroom_id

    // Une matière appartient à une classe spécifique
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
