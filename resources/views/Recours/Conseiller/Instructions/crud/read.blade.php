@extends('layouts.header')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Liste des Mesures d'instructions</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Description</th>
                    <th>Délais</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($instructions as $instruction)
                    <tr>
                        <td>{{ $instruction->nom }}</td>
                        <td>{{ $instruction->delais }}</td>
                        <td>
                            <a href="{{ route('mesure_instructions.edit', $instruction->id) }}"
                                class="btn btn-info btn-sm">Modifier
                                l'instruction</a>
                            <form action="{{ route('mesure_instructions.destroy', $instruction->id) }}" method="post">
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
