@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulaire d'enregistrement d'un role

                </h4>
                @can('role-create')
                    <form class="form-sample" method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nom" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-xl-6 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title text-black">Permissions</h4>

                                        <div class="list-wrapper">
                                            <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                                @foreach ($permissions as $value)
                                                    <li>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="checkbox" type="checkbox"
                                                                    name="permissions[{{ $value->id }}]"
                                                                    value="{{ $value->id }}"class="name">
                                                {{ $value->name }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>




                        
                        <hr>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Enregistrer le role</button>
                            </div>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection
