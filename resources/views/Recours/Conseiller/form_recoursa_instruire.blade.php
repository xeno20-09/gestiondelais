@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulaire d'enregistrement du recours</h4>
                <form class="form-sample" method="POST" action="{{ route('post_form_instruire') }}">
                    @csrf
                    <p class="card-description">Information du dossier</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Numéro du dossier</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $recours->numero_dossier }}"
                                        name="dossier_numero" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date d'enregistrement</label>
                                <div class="col-sm-9">
                                    <input type="texte" class="form-control" value="{{ $recours->date_enregistrement }}"
                                        name="date_enregistrement" readonly />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Objet</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $recours->objet->nom }}"
                                        name="objet" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Section</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $recours->section_id }}"
                                        name="section" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="card-description">Information du conseil</p>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Greffier</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                        value="{{ $recours->partie->greffier->nom }} {{ $recours->partie->greffier->prenoms }}"
                                        name="section" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Auditeur</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                        value="{{ $recours->partie->auditeur->nom }} {{ $recours->partie->auditeur->prenoms }}"
                                        name="section" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="card-description">Information de l'instruction</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mesures D'instructions</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="mesure" required>
                                        <option value="">---Faite une selection ---</option>
                                        @foreach ($mesures_intructions as $item)
                                            <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Partie concernée par la mesure</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="partie_concernee" required>
                                        <option value="Réquerant">Requerant</option>
                                        <option value="Défendeur">Defendeur</option>
                                        <option value="Deux parties">Deux parties</option>

                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
