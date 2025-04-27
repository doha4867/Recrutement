@extends('layouts.app')

@section('title', 'Gestion des comptes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4" style="color: var(--primary-light)">
    <h1>Gestion des comptes</h1>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Statut</th>
                        <th>Date de création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comptes as $compte)
                    <tr>
                        <td>{{ $compte->id }}</td>
                        <td>{{ $compte->user->nom }} {{ $compte->user->prenom }}</td>
                        <td>{{ $compte->user->email }}</td>
                        <td>{{ ucfirst($compte->user->role) }}</td>
                        <td>
                            <span class="badge bg-{{ $compte->statut === 'actif' ? 'success' : 'danger' }}">
                                {{ ucfirst($compte->statut) }}
                            </span>
                        </td>
                        <td>{{ $compte->date_creation->format('d/m/Y') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.comptes.show', $compte) }}" class="btn btn-sm btn-info">Détails</a>
                                <form action="{{ route('admin.comptes.statut', $compte) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        {{ $compte->statut === 'actif' ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.comptes.destroy', $compte) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce compte ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        {{ $comptes->links() }}
    </div>
</div>
@endsection