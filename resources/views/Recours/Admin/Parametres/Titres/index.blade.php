@extends('layouts.header')
@section('content')
    <div class="container mt-5">
        <a href="{{ route('titres.create') }}" class="btn btn-info btn-sm">Ajouter une titre</a>

        <h2 class="mb-4">Liste des titres</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($titres as $titre)
                    <tr>
                        <td>{{ $titre->nom }}</td>
                        <td>
                            <a href="{{ route('titres.edit', $titre->id) }}" class="btn btn-info btn-sm">Modifier</a>
                            <form action="{{ route('titres.destroy', $titre->id) }}" method="post">
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
