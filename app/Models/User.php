<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // Remplacez 'password' => 'hashed' par :
        // Ne pas inclure de cast pour password
    ];

    public function compte(): HasOne
    {
        return $this->hasOne(Compte::class);
    }

    public function profilCandidat(): HasOne
    {
        return $this->hasOne(ProfilCandidat::class);
    }

    public function candidatures(): HasMany
    {
        return $this->hasMany(Candidature::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCandidat(): bool
    {
        return $this->role === 'candidat';
    }
}