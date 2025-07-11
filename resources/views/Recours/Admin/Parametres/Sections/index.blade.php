@extends('layouts.header')
@section('content')
    <div class="container mt-5">
        <a href="{{ route('sections.create') }}" class="btn btn-info btn-sm">Ajouter une section</a>

        <h2 class="mb-4">Liste des sections</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom structure</th>
                    <th>Nom section</th>
                    <th>Code section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr>
                        <td>{{ $section->structure->nom_structure }}</td>
                        <td>{{ $section->nom_section }}</td>
                        <td>{{ $section->code_section }}</td>
                        <td>
                            <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-info btn-sm">Modifier</a>
                            <form action="{{ route('sections.destroy', $section->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
