@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">

            <div class="card-body px-0 overflow-auto">

                <h4 class="card-title pl-4">Liste des utilisateurs</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th>Nom & Prenoms</th>
                                <th>Role</th>
                                <th>Titre</th>
                                <th>Structure</th>
                                <th>Section</th>
                                {{--                                 <th>Active</th>
 --}}
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="table-user-name ml-3">
                                                <p class="mb-0 font-weight-medium">
                                                    @if ($item->sexe == 'Homme')
                                                        Mr
                                                    @else
                                                        Mme
                                                    @endif {{ $item->nom }} {{ $item->prenoms }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $item->role }}</td>
                                    <td>{{ $item->titre }}</td>
                                    <td>{{ $item->structure->nom_structure ?? null }}</td>
                                    <td>{{ $item->section->code_section ?? null }}</td>
                                    {{--       <td>
                                        <div class="badge badge-inverse-success"> Completed </div>
                                    </td> --}}
                                    <td>
                                        <a href="{{ route('modify_users_info', ['id' => $item->id]) }}">
                                            <div class="badge badge-inverse-success"> Modifier </div>
                                        </a>
                                        <form action="{{ route('user_destroy', ['id' => $item->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge badge-inverse-danger"
                                                style="">Supprimer</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>
            @if ($users->lastPage() > 1)
                <div class="template-demo">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                            <a href="{{ $users->url($i) }}"
                                class="btn btn-primary {{ $users->currentPage() == $i ? 'active' : '' }}">
                                {{ $i }}
                            </a>
                        @endfor
                    </div>

                </div>
            @endif

        </div>
    </div>
@endsection
