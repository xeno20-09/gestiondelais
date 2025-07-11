@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulaire d'enregistrement d'un role

                </h4>
                <form class="form-sample" method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')
                    <!--  -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nom</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nom"
                                        value="{{ $role->nom }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Modifier la role</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
