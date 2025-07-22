@extends('layouts.header')

@section('content')
    <div class="container mt-5">
        @can('permission-create')
            <a href="{{ route('permissions.create') }}" class="btn btn-info btn-sm mb-3">Ajouter une permission</a>
        @endcan
        <h2 class="mb-4">Liste des permissions</h2>

        <div class="table-responsive">
            <table id="permissionsTable" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nom de la permission</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                                @can('permission-edit')
                                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info btn-sm">Modifier</a>
                                @endcan
                                @can('permission-delete')
                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
