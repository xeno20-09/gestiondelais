@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulaire d'enregistrement d'une instruction</h4>
                <form class="form-sample" method="POST" action="{{ route('mesure_instructions.store') }}">
                    @csrf
                    <!--  -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description de l'instruction</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="description" />

                                </div>
                            </div>
                        </div>
                    </div>


                    <!--  -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Délais de l'instruction</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="delais" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Enregistrer la mesure</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
