@extends('layouts.header')
@section('content')
    <div class="container mt-5">
        @can('role-create')
            <a href="{{ route('roles.create') }}" class="btn btn-info btn-sm">Ajouter un role</a>
        @endcan
        <h2 class="mb-4">Liste des roles</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            @can('user-edit')
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info btn-sm">Modifier</a>
                            @endcan

                            @can('user-delete')
                                <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="">Supprimer</button>
                                </form>
                            @endcan

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
