@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulaire d'enregistrement d'une permission

                </h4>
                @can('permission-create')
                    <form class="form-sample" method="POST" action="{{ route('permissions.store') }}">
                        @csrf
                        <!--  -->
            
                        <!--  -->
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="nom" />
                                    </div>
                                </div>
                            </div>
                        </div>

        

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
    </div>


@endsection
