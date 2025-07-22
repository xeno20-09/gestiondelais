@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulaire d'enregistrement du recours</h4>
                <form class="form-sample" method="POST" action="{{ route('post_form_affecte') }}">
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
                                    <input type="text" class="form-control" value="{{ $recours->objet->nom}}"
                                        name="objet" placeholder="" readonly />
                                </div>
                            </div>
                        </div>

                    </div>


                    <p class="card-description">Information du conseil</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Section</label>
                                <div class="col-sm-9">
                                    <select class="form-control" onchange="getmember()" id="section" name="section">
                                        <option value="">-- Sélectionner une section --</option>
                                        @foreach ($recours->structure->sections as $item)
                                            <option value="{{ $item->id }}">{{ $item->nom_section }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Greffier</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="greffier" name="greffier">
                                        <option value="">-- Sélectionner un greffier --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Conseiller</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="conseiller" name="conseiller">
                                        <option value="">-- Sélectionner un conseiller --</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Auditeur</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="auditeur" name="auditeur">
                                        <option value="">-- Sélectionner un auditeur --</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button class="btn btn-primary">Affecter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            window.getmember = function() {
                var section = $('#section').val();

                if (section !== '') {
                    $.ajax({
                        type: 'POST',
                        url: '/gestiondelais/recours/post/affecter/membre',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            section: section,
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            // Remplir les selects avec les données
                            $('#greffier').empty().append(
                                '<option value="">-- Sélectionner un greffier --</option>');
                            data.greffiervaleurs.forEach(function(greffier) {
                                $('#greffier').append(
                                    `<option value="${greffier.id}">${greffier.nom} ${greffier.prenoms}</option>`
                                    );
                            });

                            $('#conseiller').empty().append(
                                '<option value="">-- Sélectionner un conseiller --</option>');
                            data.conseillervaleurs.forEach(function(conseiller) {
                                $('#conseiller').append(
                                    `<option value="${conseiller.id}">${conseiller.nom} ${conseiller.prenoms}</option>`
                                    );
                            });

                            $('#auditeur').empty().append(
                                '<option value="">-- Sélectionner un auditeur --</option>');
                            data.auditeurvaleurs.forEach(function(auditeur) {
                                $('#auditeur').append(
                                    `<option value="${auditeur.id}">${auditeur.nom} ${auditeur.prenoms}</option>`
                                    );
                            });
                        },
                        error: function() {
                            $('#greffier').html(
                                '<option value="">Erreur : Section introuvable.</option>');
                            $('#conseiller').html(
                                '<option value="">Erreur : Section introuvable.</option>');
                            $('#auditeur').html(
                                '<option value="">Erreur : Section introuvable.</option>');
                        },
                    });
                }
            };

            // Facultatif : Si un section est déjà sélectionné au chargement
            if ($('#section').val() !== '') {
                getmember();
            }
        });
    </script>
@endsection
