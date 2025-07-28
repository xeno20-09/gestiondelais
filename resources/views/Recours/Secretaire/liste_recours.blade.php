@extends('layouts.header')

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body px-0 overflow-auto">
                <h4 class="card-title pl-4">Liste des recours</h4>

                @if ($recours->isEmpty())
                    <p class="text-center text-muted py-4">Aucun recours pour le moment.</p>
                @else
                    <div class="table-responsive">
                        <table id="recoursTable" class="display">
                            <thead class="bg-light">
                                <tr>
                                    <th>Numéro du recours</th>
                                    <th>Date d'enregistrement</th>
                                    <th>État du dossier</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recours as $item)
                                    <tr>
                                        <td>N°{{ $item->numero_dossier }}</td>
                                        <td>{{ $item->date_enregistrement }}</td>
                                        <td>{{ $item->etat_dossier }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-1" style="justify-content: space-around;">
                                                <a class="badge badge-inverse-primary"
                                                    href="{{ route('get_detail', ['id' => $item->id]) }}">Détail</a>
                                                <a class="badge badge-inverse-info"
                                                    href="{{ route('get_history_recours', ['id' => $item->id]) }}">Historique</a>
                                                {{--     @if (Auth::user()->role == 'PCA' || Auth::user()->role == 'PCJ')
                                                    <a class="badge badge-inverse-warning"
                                                        href="{{ route('getlisterecours_a_reaffectes', ['id' => $item->id]) }}">Réaffectés</a>
                                                @endif --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
