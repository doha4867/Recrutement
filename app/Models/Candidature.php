<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'offre_id',
        'statut',
        'date_soumission',
    ];

    protected $casts = [
        'date_soumission' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function offre(): BelongsTo
    {
        return $this->belongsTo(Offre::class);
    }

    public function entretien(): HasOne
    {
        return $this->hasOne(Entretien::class);
    }

    public function soumettre(): bool
    {
        return true;
    }

    public function consulterStatut(): string
    {
        return $this->statut;
    }
}