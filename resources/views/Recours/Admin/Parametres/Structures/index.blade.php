@extends('layouts.header')
@section('content')
    <div class="container mt-5">
        <a href="{{ route('structures.create') }}" class="btn btn-info btn-sm">Ajouter une structure</a>

        <h2 class="mb-4">Liste des structures</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($structures as $structure)
                    <tr>
                        <td>{{ $structure->nom_structure }}</td>
                        <td>{{ $structure->code_structure }}</td>
                        <td>
                            <a href="{{ route('structures.edit', $structure->id) }}" class="btn btn-info btn-sm">Modifier</a>
                            <form action="{{ route('structures.destroy', $structure->id) }}" method="post">
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
