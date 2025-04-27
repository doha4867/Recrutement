@extends('layouts.app')

@section('title', 'Détails de candidature')

@section('content')
<div class="container my-4">
    <!-- Bouton Retour -->
    <div class="mb-4">
        <a href="{{ route('candidat.candidatures.index') }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-2"></i> Retour à mes candidatures
        </a>
    </div>

    <!-- Carte principale -->
    <div class="card border-0 shadow">
        <!-- En-tête -->
        <div class="card-header bg-light text-black py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="h4 mb-1">Candidature pour "{{ $candidature->offre->titre }}"</h2>
                </div>
                <span class="badge fs-6 
                    @switch($candidature->statut)
                        @case('Soumise') bg-info @break
                        @case('Acceptée') bg-success @break
                        @case('Refusée') bg-danger @break
                        @case('En attente') bg-warning text-dark @break
                        @default bg-secondary
                    @endswitch">
                    {{ $candidature->statut }}
                </span>
            </div>
        </div>

        <!-- Corps de la carte -->
        <div class="card-body">
            <!-- Détails de l'offre -->
            <section class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h5 mb-0 " style="color: var(--primary-dark)">
                        <i class="fas fa-briefcase me-2" ></i>Détails de l'offre
                    </h3>
                    <a href="{{ route('candidat.offres.show', $candidature->offre) }}" class="btn btn-sm " style="background-color:var(--primary-light); color:white">
                        Voir l'offre complète
                    </a>
                </div>
                
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <div class="row">
                           
                            <div class="col-md-4 mb-3">
                                <h4 class="h6 text-muted">Date de publication</h4>
                                <p class="mb-0">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $candidature->offre->date_publication->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h4 class="h6 text-muted">Description</h4>
                            <p class="mb-0">{{ $candidature->offre->description }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Informations de candidature -->
            <section class="mb-5">
                <h3 class="h5 mb-3" style="color:var(--primary-dark);">
                    <i class="fas fa-user-tie me-2"></i>Informations de candidature
                </h3>
                
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h4 class="h6 text-muted">Date de soumission</h4>
                                <p class="mb-0">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $candidature->date_soumission->translatedFormat('d/m/Y \à H\hi') }}
                                </p>
                            </div>
                           
                            
                        </div>
                        
                        
                    </div>
                </div>
            </section>

            <!-- Section Entretien -->
            @if($candidature->entretien)
                <section class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="h5 mb-0 " style="color: var(--primary-dark);">
                            <i class="fas fa-calendar-check me-2"></i>Entretien planifié
                        </h3>
                        
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Date et Heure -->
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                                            <i class="fas fa-calendar-alt text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <h4 class="h6 text-muted mb-1">Date et Heure</h4>
                                            <p class="mb-0 fs-5">
                                                {{ $candidature->entretien->date_heure->translatedFormat('d/m/Y \à H\hi') }}
                                            </p>
                                            @if($candidature->entretien)
                                                <span class="badge bg-warning text-dark mt-1">Aujourd'hui</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                              
                            </div>
                            
                           
                            
                            <!-- Boutons d'action -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('candidat.entretiens.show', $candidature->entretien) }}" 
                                    class="btn btn-sm " style="background-color:var(--primary-light); ">
                                   <i class="fas fa-eye me-1"></i> Voir les détails
                                </a>
                              
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun entretien n'a encore été planifié pour cette candidature.
                </div>
            @endif
        </div>
      
    </div>
</div>
@endsection