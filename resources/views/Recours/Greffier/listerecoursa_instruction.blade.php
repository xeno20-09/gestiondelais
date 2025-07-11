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
                                                <p class="mb-0 font-weight-medium">
                                                    N°{{ $item->numero_dossier }} </p>

                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->date_enregistrement }}</td>
                                    <td>
                                        <div class="badge badge-inverse-danger"> {{ $item->etat_dossier }}
                                            @if ($item->etat_dossier == 'En instruction')
                                                <small>{{ $item->lastMouvement->instruction->nom }}</small>
                                            @endif
                                        </div>

                                    </td>
                                    <td>
                                        <div class="badge badge-inverse-danger">
                                            <a href="{{ route('get_detail', ['id' => $item->id]) }}">Détail</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="badge badge-inverse-danger">
                                            <a href="{{ route('get_form_instruction', ['id' => $item->id]) }}">Exécuter</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="badge badge-inverse-danger">
                                            <a href="{{ route('get_history_recours', ['id' => $item->id]) }}">Historique</a>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        Aucun recours ne vous a été affecté pour le moment.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </div>
@endsection
