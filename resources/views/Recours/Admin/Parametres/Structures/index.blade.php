@extends('layouts.header')
@section('content')
    <div class="container mt-5">
@can('structure-create')
            <a href="{{ route('structures.create') }}" class="btn btn-info btn-sm mb-5">Ajouter une structure</a>
@endcan
        <h2 class="mb-4">Liste des structures</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Code</th>
                    
                 @if(Auth::user()->can('structure-edit') && Auth::user()->can('structure-delete'))
    <th>Actions</th>
@endif

                </tr>
            </thead>
            <tbody>
                @foreach ($structures as $structure)
                    <tr>

                        <td>{{ $structure->nom_structure }}</td>
                        <td>{{ $structure->code_structure }}</td>
                        
                                      @if(Auth::user()->can('structure-edit') && Auth::user()->can('structure-delete'))
                        <td style="display: flex;flex-direction: row;justify-content: space-around; ">
                            @can('structure-edit')
                                <a href="{{ route('structures.edit', $structure->id) }}" class="btn btn-info btn-sm">Modifier</a>
                            @endcan
                            @can('structure-delete')
                                <form action="{{ route('structures.destroy', $structure->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="">Supprimer</button>
                                </form>
                            @endcan
                        </td>@endif

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
