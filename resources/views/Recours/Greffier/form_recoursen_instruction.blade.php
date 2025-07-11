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
                                    <input type="text" class="form-control" value="{{ $recours->objet }}" name="objet"
                                        placeholder="" readonly />
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
                                        <option value="Initiée">Initiée</option>
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
    <script>
        function getmember() {
            // Récupération des valeurs entrées par l'utilisateur dans les champs Nombre 1 et Nombre 2.
            var section = document.getElementById('section').value;

            //console.log(monnaie);

            if (section !== 'null') {
                $.ajax({
                    type: 'POST',
                    url: '/recours/post/affecter/membre',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        section: section,
                    },
                    dataType: 'JSON',

                    success: function(data) {
                        // Vider le select greffier
                        $('#greffier').empty().append(
                            '<option value="">-- Sélectionner un greffier --</option>');

                        // Remplir le select greffier
                        data.greffiervaleurs.forEach(function(greffier) {
                            $('#greffier').append(
                                `<option value="${greffier.id}">${greffier.nom} ${greffier.prenoms}</option>`
                            );
                        });

                        // Vider le select conseiller
                        $('#conseiller').empty().append(
                            '<option value="">-- Sélectionner un conseiller --</option>');

                        // Remplir le select conseuller
                        data.conseillervaleurs.forEach(function(conseiller) {
                            $('#conseiller').append(
                                `<option value="${conseiller.id}">${conseiller.nom} ${conseiller.prenoms}</option>`
                            );
                        });


                        // Vider le select auditeur
                        $('#auditeur').empty().append(
                            '<option value="">-- Sélectionner un auditeur --</option>');

                        // Remplir le select :auditeur
                        data.auditeurvaleurs.forEach(function(auditeur) {
                            $('#auditeur').append(
                                `<option value="${auditeur.id}">${auditeur.nom} ${auditeur.prenoms}</option>`
                            );
                        });
                    },
                    error: function() {
                        $('#greffier').empty().append(
                            '<option value="">Erreur : Section introuvable.</option>');
                        $('#conseiller').empty().append(
                            '<option value="">Erreur : Section introuvable.</option>');
                        $('#auditeur').empty().append(
                            '<option value="">Erreur : Section introuvable.</option>');
                    },

                });

            }
        }
        getmember();
    </script>
@endsection
