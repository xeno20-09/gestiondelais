@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulaire d'enregistrement d'une structure

                </h4>
                @can('structure-update')
                    <form class="form-sample" method="POST" action="{{ route('structures.update', $structure->id) }}">
                        @csrf
                        @method('PUT')
                        <!--  -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nom"
                                            value="{{ $structure->nom_structure }}" />

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--  -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="code"
                                            value="{{ $structure->code_structure }}" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Modifier la structure</button>
                            </div>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection
