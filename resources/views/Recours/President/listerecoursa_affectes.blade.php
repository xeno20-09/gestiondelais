@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th>Numéro du recours</th>
                                <th>Date enregistrement du dossier</th>
                                <th>Etat du dossier</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recours as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="table-user-name ml-3">
                                                <p class="mb-0 font-weight-medium">N°{{ $item->numero_dossier }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->date_enregistrement }}</td>
                                    <td>
                                        <div class="badge badge-inverse-danger">
                                            {{ $item->etat_dossier }}
                                            @if ($item->etat_dossier == 'En instruction')
                                                <small>{{ $item->lastMouvement->instruction->nom }}</small>
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-wrap gap-1" style="justify-content: space-around;">
                                            <a class="badge badge-inverse-primary"
                                                href="{{ route('get_detail', ['id' => $item->id]) }}">Détail</a>
                                            <a class="badge badge-inverse-info"
                                                href="{{ route('get_history_recours', ['id' => $item->id]) }}">Historique</a>
                                            <a class="badge badge-inverse-warning"
                                                href="{{ route('get_form_affecte', ['id' => $item->id]) }}">Affecter</a>
                                            @if ($item->partie->conseiller != null)
                                                <a class="badge badge-inverse-warning"
                                                    href="{{ route('getlisterecours_a_reaffectes', ['id' => $item->id]) }}">Réaffectés</a>
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Aucun recours à afficher.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
