@extends('layouts.app')

@section('title', 'Mes candidatures')

@section('content')
<h1 style="color: var(--primary-dark)">Mes candidatures</h1>

<div class="card mt-4">
    <div class="card-body">
        @if($candidatures->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Offre</th>
                            <th>Date de soumission</th>
                            <th>Statut</th>
                            <th>Entretien</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($candidatures as $candidature)
                            <tr>
                                <td>{{ $candidature->offre->titre }}</td>
                                <td>{{ $candidature->date_soumission->format('d/m/Y') }}</td>
                                <td>
                                    <span style="background-color: var(--primary-light)"class="badge bg-{{ $candidature->statut === 'Soumise' ? 'primary' : ($candidature->statut === 'Acceptée' ? 'success' : 'danger') }}">
                                        {{ $candidature->statut }}
                                    </span>
                                </td>
                                <td>
                                    @if($candidature->entretien)
                                            <a href="{{ route('candidat.entretiens.show', $candidature->entretien) }}" 
                                               class="text-decoration-none d-flex align-items-center">
                                               <i class="fas fa-calendar-check me-2 text-primary"></i>
                                               {{ $candidature->entretien->date_heure->format('d/m H:i') }}
                                            </a>
                                        @else
                                        <span class="text-muted">Non planifié</span>
                                        @endif
                                </td>
                                <td>
                                    <a href="{{ route('candidat.candidatures.show', $candidature) }}" class="btn btn-sm " style="color: var(--text-color)">Détails</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $candidatures->links() }}
            </div>
        @else
            <div class="alert alert-info">
                Vous n'avez pas encore postulé à une offre. <a href="{{ route('candidat.offres.index') }}">Découvrir les offres</a>
            </div>
        @endif
    </div>
</div>
@endsection