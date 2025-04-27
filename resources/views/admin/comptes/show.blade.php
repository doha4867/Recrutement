@php
use Carbon\Carbon;
@endphp

@extends('layouts.app')
@section('title', 'Détails du compte')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{ route('admin.comptes.index') }}" class="btn ">
            <i class="fas fa-arrow-left me-1"></i> Retour à la liste
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: var(--primary-color); color: white;">
            <h4 class="mb-0"><i class="fas fa-user-circle me-2"></i>Détails du compte</h4>
          
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Informations utilisateur -->
                <div class="col-md-6">
                    <div class=" mb-4">
                        <div class="card-header" style="background-color: var(--bg-dark);">
                            <h5 class="mb-0"><i class="fas fa-user me-2"></i>Informations utilisateur</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th width="40%">ID</th>
                                        <td>{{ $compte->user->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nom complet</th>
                                        <td>{{ $compte->user->prenom }} {{ $compte->user->nom }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $compte->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rôle</th>
                                        <td>
                                            <span class="badge bg-{{ $compte->user->role === 'admin' ? 'danger' : 'primary' }}">
                                                {{ ucfirst($compte->user->role) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Inscription</th>
                                        <td>
                                            {{ $compte->user->created_at->format('d/m/Y H:i') }}
                                            <small class="text-muted">({{ $compte->user->created_at->diffForHumans() }})</small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Informations du compte -->
                <div class="col-md-6">
                    <div class=" mb-8">
                        <div class="card-header" style="background-color: var(--bg-dark);">
                            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informations du compte</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th width="40%">Statut</th>
                                        <td>
                                            <span class="badge bg-{{ $compte->statut === 'actif' ? 'success' : 'danger' }}">
                                                {{ ucfirst($compte->statut) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Création</th>
                                        <td>{{ $compte->date_creation ? $compte->date_creation->format('d/m/Y') : 'Non défini' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dernière activité</th>
                                        <td>{{ date('d/m/Y H:i', strtotime('-2 days')) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Actions de gestion -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color: var(--primary-light);">
                    <h5 class="mb-0" style="color: white"><i class="fas fa-cog me-2"></i>Gestion du compte</h5>
                </div>
                <div class="card-body mt-5">
                    <form action="{{ route('admin.comptes.statut', $compte) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-{{ $compte->statut === 'actif' ? 'warning' : 'success' }} w-100">
                            <i class="fas fa-{{ $compte->statut === 'actif' ? 'times' : 'check' }} me-1"></i>
                            {{ $compte->statut === 'actif' ? 'Désactiver le compte' : 'Activer le compte' }}
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.comptes.destroy', $compte) }}" method="POST" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ? Cette action est irréversible.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash-alt me-1"></i> Supprimer le compte
                        </button>
                    </form>
                    
                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center" style="background-color: var(--primary-light); color: white;">
                    <h5 class="mb-0"><i class="fas fa-key me-2"></i>Changer le mot de passe</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.comptes.password', $compte->user) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Nouveau mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmation</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn w-100" style="color: var(--primary-dark)">
                            <i class="fas fa-save me-1"></i> Enregistrer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Candidatures (si candidat) -->
    @if($compte->user->role === 'candidat')
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center"style="background-color:var(--primary-light);">
                <h5 class="mb-0" style="color: white"><i class="fas fa-file-alt me-2"></i>Candidatures</h5>
                <span class="badge">{{ $compte->user->candidatures->count() }}</span>
            </div>
            <div class="card-body" >
                @if($compte->user->candidatures->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Offre</th>
                                    <th>Soumission</th>
                                    <th>Statut</th>
                                    <th>Entretien</th>
                             
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($compte->user->candidatures as $candidature)
                                    <tr>
                                        <td>{{ $candidature->offre->titre }}</td>
                                        <td>{{ $candidature->date_soumission->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $candidature->statut === 'Soumise' ? 'primary' : ($candidature->statut === 'Acceptée' ? 'success' : 'danger') }}">
                                                {{ $candidature->statut }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($candidature->entretien)
                                                <span >
                                                    {{ $candidature->entretien->date_heure->format('d/m/Y H:i') }}
                                                </span>
                                            @else
                                                <span class="text-muted">Non planifié</span>
                                            @endif
                                        </td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-file-alt fa-3x mb-3" style="color: var(--text-lighter);"></i>
                        <p class="text-muted">Aucune candidature enregistrée</p>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Journal d'activité -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: var(--primary-light);">
            <h5 class="mb-0" style="color: white"><i class="fas fa-history me-2"></i>Journal d'activité</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-sign-in-alt me-2 text-primary"></i>
                        <span>Dernière connexion</span>
                    </div>
                    <span class="text-muted">{{ date('d/m/Y H:i', strtotime('-2 days')) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-edit me-2 text-info"></i>
                        <span>Dernière modification</span>
                    </div>
                    <span class="text-muted">{{ date('d/m/Y H:i', strtotime('-1 week')) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-user-plus me-2 text-success"></i>
                        <span>Création du compte</span>
                    </div>
                    <span class="text-muted">{{ $compte->user->created_at->format('d/m/Y H:i') }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection