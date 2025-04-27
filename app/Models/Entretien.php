<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entretien extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidature_id',
        'date_heure',
        'lieu',
    ];

    protected $casts = [
        'date_heure' => 'datetime',
    ];

    public function candidature(): BelongsTo
    {
        return $this->belongsTo(Candidature::class);
    }

    public function planifier($dateHeure, $lieu): bool
    {
        // Logique de planification
        return true;
    }

    public function modifier($donnees): bool
    {
        // Logique de modification
        return true;
    }

    public function annuler(): bool
    {
        // Logique d'annulation
        return true;
    }
}