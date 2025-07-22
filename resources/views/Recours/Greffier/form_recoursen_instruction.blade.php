@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulaire d'enregistrement du recours</h4>
                <form class="form-sample" method="POST" action="{{ route('post_form_instruction') }}">
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
                                <label class="col-sm-3 col-form-label">Conseiller</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                        value="{{ $recours->partie->conseiller->nom }} {{ $recours->partie->conseiller->prenoms }}"
                                        name="conseiller" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Auditeur</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                        value="{{ $recours->partie->auditeur->nom }} {{ $recours->partie->auditeur->prenoms }}"
                                        name="auditeur" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                    </div>



                    <p class="card-description">Information de la mesure</p>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Partie concernée</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                        value="{{ $recours->lastMouvement->communique_au }}" name="partie_concernee"
                                        placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-sm-9 input-group">
                                    <label class="col-sm-3 col-form-label">Instruction</label>

                                    <input type="text" class="form-control"
                                        value="{{ $recours->lastMouvement->instruction->nom }}" name="instruction"
                                        placeholder="" readonly />
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{ $recours->lastMouvement->instruction->delais }}
                                            jours</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="card-description">Information à completer</p>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Etat actuel
                                    :{{ $recours->lastMouvement->etat_instruction }}</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="etat_instruction" required>
                                        <option value="">---Faite une selection ---</option>
                                        <option value="Executée">Executée</option>
                                        <option value="Contacté">Contacté</option>
                                        <option value="Inachevée">Inachevée</option>
                                        <option value="Non Contacté">Non Contacté</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date de notification</label>
                                <div class="col-sm-9">
                                    @if ($recours->lastMouvement->etat_instruction == 'Contacté')
                                        <input type="text" class="form-control" name="date_notification"
                                            value="{{ $recours->lastMouvement->date_debut_notification }}" />
                                    @elseif($recours->lastMouvement->etat_instruction != 'Contacté')
                                        <input type="date" class="form-control" name="date_notification" />
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Observation</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="exampleTextarea1" name="observation" rows="8">
                                        @isset($recours->lastMouvement->observation)
{{ $recours->lastMouvement->observation }}
@endisset
                                   </textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button class="btn btn-primary">Exécuter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script></script>
@endsection
