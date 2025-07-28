@extends('layouts.header')
@section('content')
    <div class="container mt-5">
        @can('section-create')
            <a href="{{ route('sections.create') }}" class="btn btn-info btn-sm mb-5">Ajouter une section</a>
        @endcan
        <h2 class="mb-4">Liste des sections</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom structure</th>
                    <th>Nom section</th>
                    <th>Code section</th>
                                     @if(Auth::user()->can('section-edit') && Auth::user()->can('section-delete'))

                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr>
                        <td>{{ $section->structure->nom_structure }}</td>
                        <td>{{ $section->nom_section }}</td>
                        <td>{{ $section->code_section }}</td>
                                         @if(Auth::user()->can('section-edit') && Auth::user()->can('section-delete'))

                        <td style="display: flex;flex-direction: row;justify-content: space-around; ">
                            @can('section-edit')
                                <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-info btn-sm">Modifier</a>
                            @endcan
                            @can('section-delete')
                                <form action="{{ route('sections.destroy', $section->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="">Supprimer</button>
                                </form>
                            @endcan

                        </td>
                        @endif
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
