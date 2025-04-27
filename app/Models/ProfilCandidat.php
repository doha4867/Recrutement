<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfilCandidat extends Model
{
    use HasFactory;

    protected $table = 'profils_candidats';

    protected $fillable = [
        'user_id',
        'telephone',
        'profil',
        'cv',
        'adresse',
        'photo_profil',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gererProfil($donnees): bool
    {
        return true;
    }

    public function modifierProfil($donnees): bool
    {
        return true;
    }
}