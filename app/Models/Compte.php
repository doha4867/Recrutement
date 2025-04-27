<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Compte extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom_utilisateur',
        'email',
        'mot_de_passe',
        'role',
        'date_creation',
        'statut',
    ];

    protected $casts = [
        'date_creation' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function authentifier($email, $motDePasse): bool
    {
        return true;
    }

    public function changerMotDePasse($nouveauMotDePasse): bool
    {
        return true;
    }

    public function verifierStatut(): string
    {
        return $this->statut;
    }
}