@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body px-0 overflow-auto">
                <h4 class="card-title pl-4">Liste des recours</h4>

                @if (empty($recours))
                    <p class="text-center text-muted py-4">Aucun recours pour le moment.</p>
                @else
                    <div class="table-responsive">
                        <table id="recoursInstruireTable" class="display">
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
                                            <div class="badge badge-inverse-danger">
                                                <a
                                                    href="{{ route('get_form_instruction', ['id' => $item->id]) }}">Exécuter</a>
                                            </div>
                                            <div class="badge badge-inverse-danger">
                                                <a
                                                    href="{{ route('get_history_recours', ['id' => $item->id]) }}">Historique</a>
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
