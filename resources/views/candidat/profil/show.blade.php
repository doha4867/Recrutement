@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="container my-4">
    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2" style="color: var(--primary-light)">
            <i class="fas fa-user-circle me-2" ></i>Mon profil
        </h1>
        <a  style="background-color: var(--primary-light) ; color:white" href="{{ route('candidat.profil.edit') }}" class="btn">
            <i class="fas fa-edit me-1" ></i> Modifier mon profil
        </a>
    </div>

    <div class="row">
        <!-- Colonne gauche - Photo et infos de base -->
        <div class="col-lg-4 mb-4">
            <!-- Carte photo de profil -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body text-center py-4">
                    @if($profil->photo_profil)
                    <img src="{{ asset('storage/' . $profil->photo_profil) }}" 
                             alt="Photo de profil" 
                             class="img-fluid rounded-circle mb-3 shadow" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <div class=" text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 shadow" 
                             style="width: 150px; height: 150px ; background-color: var(--primary-light);">
                            <span class="display-4 fw-bold">{{ substr($user->prenom, 0, 1) }}{{ substr($user->nom, 0, 1) }}</span>
                        </div>
                    @endif
                    
                    <h3 class="h4 mb-2">{{ $user->prenom }} {{ $user->nom }}</h3>
                    <p class="text-muted mb-3">
                        <i class="fas fa-envelope me-1"></i> {{ $user->email }}
                    </p>
                    
                    <div class="d-flex justify-content-center gap-3">
                        @if($profil->telephone)
                            <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                <i class="fas fa-phone me-1 text-primary"></i> {{ $profil->telephone }}
                            </span>
                        @endif
                        
                        @if($profil->adresse)
                            <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                <i class="fas fa-map-marker-alt me-1 text-primary"></i> {{ Str::limit($profil->adresse, 20) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Carte CV -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h3 class="h5 mb-0">
                        <i class="fas fa-file-alt me-2"></i>Mon CV
                    </h3>
                </div>
                <div class="card-body">
                    @if($profil->cv)
                        <div class="alert alert-success d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 fa-2x text-success"></i>
                            <div>
                                <p class="mb-1">CV disponible</p>
                            
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-3 fa-2x text-warning"></i>
                            <div>
                                <p class="mb-2">Vous n'avez pas encore de CV</p>
                                <a href="{{ route('candidat.profil.edit') }}" 
                                   class="btn btn-sm ">
                                   <i class="fas fa-upload me-1"></i> Téléverser un CV
                                </a>
                            </div>
                        </div>
                    @endif
                    
                    <hr>
                    
                    <h4 class="h6 mt-3 mb-2">Autres options</h4>
                    <a href="{{ route('candidat.cv.create') }}" 
                       class="btn btn-success w-100 mb-2" >
                       <i class="fas fa-magic me-1"></i> Créer un CV en ligne
                    </a>
                    @if($profil->cv)
                        <a href="{{ route('candidat.profil.edit') }}" 
                           class="btn btn-sm btn-outline-danger w-100">
                           <i class="fas fa-sync-alt me-1"></i> Mettre à jour mon CV
                        </a>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Colonne droite - Détails et candidatures -->
        <div class="col-lg-8">
            <!-- Section À propos -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h3 class="h5 mb-0">
                        <i class="fas fa-user-tie me-2"></i>À propos de moi
                    </h3>
                </div>
                <div class="card-body">
                    @if($profil->profil)
                        <div class="profil-description">
                            {!! nl2br(e($profil->profil)) !!}
                        </div>
                    @else
                        <div class="alert alert-light d-flex align-items-center">
                            <i class="fas fa-info-circle me-3 fa-2x " style="color: var(--primary-light)"></i>
                            <div>
                                <p class="mb-0" >Vous n'avez pas encore ajouté de description à votre profil.</p>
                                <a href="{{ route('candidat.profil.edit') }}" class="btn btn-smmt-2"  >
                                    <i class="fas fa-plus me-1"></i> Ajouter une description
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
           
            
            <!-- Section Candidatures récentes -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h3 class="h5 mb-0">
                        <i class="fas fa-file-alt me-2"></i>Mes candidatures récentes
                    </h3>
                </div>
                <div class="card-body">
                    @if($user->candidatures()->count() > 0)
                        <div class="list-group">
                            @foreach($user->candidatures()->latest()->take(3)->get() as $candidature)
                                <a href="{{ route('candidat.candidatures.show', $candidature) }}" 
                                   class="list-group-item list-group-item-action border-0 rounded-2 shadow-sm mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="mb-1">{{ $candidature->offre->titre }}</h5>
                                          
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted d-block">{{ $candidature->date_soumission->format('d/m/Y') }}</small>
                                            <span class="badge 
                                                @switch($candidature->statut)
                                                    @case('Acceptée') bg-success @break
                                                    @case('Refusée') bg-danger @break
                                                    @default bg-primary
                                                @endswitch">
                                                {{ $candidature->statut }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                           
                            <a href="{{ route('candidat.candidatures.index') }}" class="btn " >
                                <i class="fas fa-list me-1"></i> Voir toutes mes candidatures
                            </a>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-file-alt fa-3x mb-3 text-muted"></i>
                            <h4 class="h5 text-muted">Aucune candidature</h4>
                            <p class="text-muted">Vous n'avez pas encore postulé à des offres.</p>
                            <a href="{{ route('candidat.offres.index') }}" class="btn btn-primary mt-2">
                                <i class="fas fa-briefcase me-1"></i> Explorer les offres
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .profil-description {
        line-height: 1.8;
        white-space: pre-wrap;
    }
    .card {
        border-radius: 0.5rem;
    }
    .list-group-item {
        transition: all 0.3s ease;
    }
    .list-group-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>
@endpush