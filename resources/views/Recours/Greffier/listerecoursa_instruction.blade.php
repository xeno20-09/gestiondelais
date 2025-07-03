@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            @if ($recours)
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

                                            <div class="dropdown">
                                                <button class="btn btn-sm ml-3 btn-success dropdown-toggle" type="button"
                                                    id="dropdownMenuOutlineButton5" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"> Voir </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuOutlineButton5">
                                                    <h6 class="dropdown-header">Actions</h6>
                                                    <a class="dropdown-item"
                                                        href="{{ route('get_form_instruction', ['id' => $item->id]) }}">Exécuter</a>

                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="mt-4">
                    Aucun recours trouvé pour votre recherche.
                </div>
            @endif


        </div>
    </div>
@endsection
