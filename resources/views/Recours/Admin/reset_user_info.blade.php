@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulaire de modification du personnel</h4>
                @can('user-update')
                    <form class="form-sample" method="POST"
                        action=" {{ route('post_form_modify_info', ['id' => $user_info->id]) }}">
                        @csrf
                        <p class="card-description">Information du personnel</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nom</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user_info->nom }}" name="nom"
                                            placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Prenoms</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user_info->prenoms }}"
                                            name="prenoms" placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{ $user_info->email }}"
                                            name="email" placeholder="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="role">
                                            <option value="{{ $user_info->role }}">{{ $user_info->role }}</option>
                                            @foreach ($roles as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Titre</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="titre">
                                            <option value="{{ $user_info->titre }}">{{ $user_info->titre }}</option>
                                            @foreach ($titres as $item)
                                                <option value="{{ $item->nom }}">{{ $item->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Structure</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="structure" id="">
                                            <option value="{{ $user_info->structure->id ?? null }}">
                                                {{ $user_info->structure->nom_structure ?? null }}</option>
                                            @foreach ($structures as $item)
                                                <option value="{{ $item->id }}">{{ $item->nom_structure }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Section</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="section" id="">
                                            <option value="{{ $user_info->section->id ?? null }}">
                                                {{ $user_info->section->nom_section ?? null }}</option>
                                            @foreach ($sections as $item)
                                                <option value="{{ $item->id }}">{{ $item->nom_section }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Permissions</h4>
                                <div class="row py-2">
                                    <div class="col-sm-12">
                                        @foreach ($role->permissions as $permission)
                                            <div class="d-flex justify-content-between pb-3 border-bottom">
                                                <div>
                                                    <span class="p">{{ $permission->name }}</span>
                                                </div>
                                                <p class="mb-0"><i class=" mdi mdi-check-decagram "></i></p>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button class="btn btn-primary">Modifier</button>
                            </div>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection
