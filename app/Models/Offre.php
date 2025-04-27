<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offre extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'date_publication',
    ];

    protected $casts = [
        'date_publication' => 'date',
    ];

    public function candidatures(): HasMany
    {
        return $this->hasMany(Candidature::class);
    }

    public function publier(): bool
    {
        return true;
    }

    public function modifier($donnees): bool
    {
  
        return true;
    }

    public function supprimer(): bool
    {
        return true;
    }
}