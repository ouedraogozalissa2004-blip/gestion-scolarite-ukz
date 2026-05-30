<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    // Ajout de payment_date dans la liste des colonnes autorisées
    protected $fillable = ['student_id', 'amount_paid', 'payment_date']; 

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
