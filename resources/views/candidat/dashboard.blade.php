@extends('layouts.app')

@section('title', 'Tableau de bord Candidat')

@section('content')
<div class="container mt-2">
    <!-- Offres Disponibles -->
    <section class="mb-5">
        <h2 style="color: var( --primary-dark);">Offres Disponibles</h2>
        <div class="card" style="background-color: var(--bg-light); border: 1px solid var(--border-color);">
            <div class="card-body">
                @if($offresRecentes->count() > 0)
                    <p>Découvrez les offres disponibles pour vous.</p>
                    <div class="list-group mt-3">
                        @foreach($offresRecentes as $offre)
                            <a href="{{ route('candidat.offres.show', $offre) }}" 
                               class="list-group-item list-group-item-action mb-2 border-0 rounded-2 shadow-sm"
                               style="transition: var(--transition);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold">{{ $offre->titre }}</span>
                                    <small class="text-muted">{{ $offre->date_publication->format('d/m/Y') }}</small>
                                </div>
                                <p class="mb-1 text-muted">{{ Str::limit($offre->description, 100) }}</p>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-2">
                        <i class="fas fa-briefcase fa-2x mb-2" style="color: var(--text-lighter);"></i>
                        <p class="text-muted">Aucune offre disponible pour le moment.</p>
                    </div>
                @endif
                <a href="{{ route('candidat.offres.index') }}" class="btn mt-3" style="background-color: var(--primary-color); color:white">Voir toutes les offres</a>
            </div>
        </div>
    </section>

    <!-- Candidatures -->
    <section class="mb-5">
        <h2 style="color: var( --primary-dark);">Candidatures</h2>
        <div class="card" style="background-color: var(--bg-light); border: 1px solid var(--border-color);">
            <div class="card-body">
                @if($candidatures->count() > 0)
                    <p>Consultez vos candidatures et leur statut.</p>
                    <div class="list-group mt-3">
                        @foreach($candidatures as $candidature)
                            <a href="{{ route('candidat.candidatures.show', $candidature) }}" 
                               class="list-group-item list-group-item-action mb-2 border-0 rounded-2 shadow-sm"
                               style="transition: var(--transition);">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold">{{ $candidature->offre->titre }}</span>
                                    <small class="text-muted">{{ $candidature->date_soumission->format('d/m/Y') }}</small>
                                </div>
                                <span class="badge mt-2 
                                    @if($candidature->statut == 'en_attente') bg-warning text-dark
                                    @elseif($candidature->statut == 'accepte') bg-success
                                    @elseif($candidature->statut == 'refuse') bg-danger
                                    @else bg-info @endif">
                                    {{ ucfirst(str_replace('_', ' ', $candidature->statut)) }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-2">
                        <i class="fas fa-file-alt fa-2x mb-2" style="color: var(--text-lighter);"></i>
                        <p class="text-muted">Vous n'avez pas encore de candidature.</p>
                    </div>
                @endif
                <a href="{{ route('candidat.candidatures.index') }}" class="btn mt-3" style="background-color: var(--primary-color); ; color:white" >Voir mes candidatures</a>
            </div>
        </div>
    </section>

    <!-- Entretiens -->
    <section>
        <h2 style="color: var( --primary-dark);">Entretiens</h2>
        <div class="card" style="background-color: var(--bg-light); border: 1px solid var(--border-color);">
            <div class="card-body">
                @if($entretiens->count() > 0)
                    <p>Suivez vos entretiens planifiés.</p>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Offre</th>
                                    <th>Date et Heure</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entretiens as $candidature)
                                    <tr>
                                        <td class="fw-semibold">{{ $candidature->offre->titre }}</td>
                                        <td>
                                            {{ $candidature->entretien->date_heure->format('d/m/Y H:i') }}
                                            @if($candidature->entretien)
                                                <span class="badge bg-warning text-dark ms-2">Aujourd'hui</span>
                                            @endif
                                        </td>
                                        
                                      
                                        <td>
                                            <a href="{{ route('candidat.entretiens.show', $candidature->entretien) }}" 
                                               class="btn btn-sm btn-light">
                                               <i class="fas fa-eye me-1"></i> Détails
                                            </a>
                                           
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-2">
                        <i class="fas fa-calendar-alt fa-2x mb-2" style="color: var(--text-lighter);"></i>
                        <p class="text-muted">Vous n'avez pas d'entretien prévu pour le moment.</p>
                    </div>
                @endif
                <a href="{{ route('candidat.entretiens.index') }}" class="btn mt-3" style="background-color: var(--primary-color); ; color:white">Voir mes entretiens</a>
            </div>
        </div>
    </section>
</div>
@endsection