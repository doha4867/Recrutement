@extends('layouts.app')

@section('title', 'Détails de l\'entretien')

@section('content')
<div class="container my-4">
    <!-- Bouton Retour -->
    <div class="mb-4">
        <a href="{{ route('candidat.entretiens.index') }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-2"></i> Retour aux entretiens
        </a>
    </div>

    <!-- Carte principale -->
    <div class="card border-0 shadow">
        <!-- En-tête -->
        <div class="card-header bg-light text-black py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h4 mb-1">
                        <i class="fas fa-calendar-check me-2"></i>Entretien pour "{{ $entretien->candidature->offre->titre }}"
                    </h1>
                  
                </div>
            </div>
        </div>

        <!-- Corps de la carte -->
        <div class="card-body">
            <div class="row">
                <!-- Colonne Informations Entretien -->
                <div class="col-lg-6 mb-4">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body">
                            <h3 class="h5 mb-4" style="color: var(--primary-dark);">
                                <i class="fas fa-info-circle me-2" ></i>Informations de l'entretien
                            </h3>
                            
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="fas fa-calendar-alt text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h4 class="h6 text-muted mb-1">Date et Heure</h4>
                                    <p class="mb-0 fs-5">
                                        {{ $entretien->date_heure->translatedFormat('d/m/Y \à H\hi') }}
                                    </p>
                                    @if($entretien->date_heure->isToday())
                                        <span class="badge bg-warning text-dark mt-1">Aujourd'hui</span>
                                    @endif
                                </div>
                            </div>
                            
                            {{-- <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    @if($entretien->mode === 'visio')
                                        <i class="fas fa-video text-primary fs-4"></i>
                                    @else
                                        <i class="fas fa-building text-primary fs-4"></i>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="h6 text-muted mb-1">Mode</h4>
                                    <p class="mb-0 fs-5">
                                        {{ $entretien->mode === 'visio' ? 'Visio-conférence' : 'Présentiel' }}
                                    </p>
                                    @if($entretien->mode === 'visio')
                                        <a href="{{ $entretien->lien_visio }}" target="_blank" class="small text-primary">
                                            <i class="fas fa-external-link-alt me-1"></i>Lien de connexion
                                        </a>
                                    @endif
                                </div>
                            </div> --}}
                            
                            {{-- <div class="d-flex align-items-start">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="fas fa-info-circle text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h4 class="h6 text-muted mb-1">Instructions</h4>
                                    <p class="mb-0">
                                        {{ $entretien->instructions ?? 'Aucune instruction supplémentaire' }}
                                    </p>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <!-- Colonne Détails Candidature -->
                <div class="col-lg-6 mb-4">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body">
                            <h3 class="h5 mb-4 " style="color: var(--primary-dark);">
                                <i class="fas fa-file-alt me-2"></i>Détails de la candidature
                            </h3>
                            
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="fas fa-tasks text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h4 class="h6 text-muted mb-1">Statut</h4>
                                    <span class="badge rounded-pill 
                                        @switch($entretien->candidature->statut)
                                            @case('Acceptée') bg-success @break
                                            @case('Refusée') bg-danger @break
                                            @case('En attente') bg-warning text-dark @break
                                            @default bg-primary
                                        @endswitch fs-6">
                                        {{ $entretien->candidature->statut }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="far fa-calendar text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h4 class="h6 text-muted mb-1">Date de soumission</h4>
                                    <p class="mb-0">
                                        {{ $entretien->candidature->date_soumission->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>
                            
                            {{-- <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                    <i class="fas fa-paperclip text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h4 class="h6 text-muted mb-1">Documents</h4>
                                    <div>
                                        <a href="{{ asset('storage/' . $entretien->candidature->cv_path) }}" 
                                           target="_blank" 
                                           class="d-block text-decoration-none mb-2">
                                           <i class="far fa-file-pdf me-1 text-danger"></i> Voir le CV
                                        </a>
                                        @if($entretien->candidature->lettre_motivation_path)
                                            <a href="{{ asset('storage/' . $entretien->candidature->lettre_motivation_path) }}" 
                                               target="_blank" 
                                               class="d-block text-decoration-none">
                                               <i class="far fa-file-alt me-1 text-primary"></i> Voir la lettre de motivation
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Détails de l'offre -->
            <div class="card bg-light border-0 mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h5 mb-0 " style="color: var(--primary-dark); ">
                            <i class="fas fa-briefcase me-2"></i>Détails de l'offre
                        </h3>
                        <a href="{{ route('candidat.offres.show', $entretien->candidature->offre) }}" 
                           class="btn btn-sm " style="background-color: var(--primary-light); color:white">
                           Voir l'offre complète
                        </a>
                    </div>
                    
                    <div class="row">
                       
                        <div class="col-md-4 mb-3">
                            <h4 class="h6 text-muted">Localisation</h4>
                            <p class="mb-0">
                               
                                
                                    <i class="fas fa-map-marker-alt me-1"></i>{{ $entretien->lieu }}

                            </p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h4 class="h6 text-muted">Date de publication</h4>
                            <p class="mb-0">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ $entretien->candidature->offre->date_publication->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <h4 class="h6 text-muted">Description</h4>
                        <p class="mb-0">{{ $entretien->candidature->offre->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Alertes et actions -->
            @if($entretien->date_heure->isFuture())
                <div class="alert alert-info mt-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle fa-2x me-3"></i>
                        <div>
                            <h4 class="h5 mb-2">Votre entretien approche !</h4>
                            <p class="mb-0">
                                Prévu {{ $entretien->date_heure->diffForHumans() }} ({{ $entretien->date_heure->translatedFormat('d/m/Y \à H\hi') }})
                            </p>
                            
                        </div>
                    </div>
                </div>
                
               
            
                
            @endif
        </div>
    </div>
</div>


@endsection