@extends('layouts.app')

@section('title', 'Mes entretiens')

@section('content')
<h1>Mes entretiens</h1>

<div class="card mt-4">
    <div class="card-body">
        @if($entretiens->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Offre</th>
                            <th>Date et heure</th>
                            <th>Lieu</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entretiens as $entretien)
                            <tr>
                                <td>{{ $entretien->candidature->offre->titre }}</td>
                                <td>{{ $entretien->date_heure->format('d/m/Y H:i') }}</td>
                                <td>{{ $entretien->lieu }}</td>
                                <td>
                                    <a href="{{ route('candidat.entretiens.show', $entretien) }}" class="btn btn-sm " style="color: var(--primary-dark);">Détails</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $entretiens->links() }}
            </div>
        @else
            <div class="alert alert-info">
                Vous n'avez pas d'entretien planifié pour le moment.
            </div>
        @endif
    </div>
</div>
@endsection