@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulaire d'enregistrement d'une section

                </h4>
                <form class="form-sample" method="POST" action="{{ route('sections.store') }}">
                    @csrf
                    <!--  -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nom structure</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="structure_id">
                                        <option value="">-- Sélectionner une structure --</option>
                                        @foreach ($structures as $item)
                                            <option value="{{ $item->id }}">{{ $item->nom_structure }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="row section-item">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nom</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nom[0]" />
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Code</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="code[0]" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger btn-remove-section"
                                style="display: none;">Supprimer</button>
                        </div>
                    </div>

                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-primary" id="btn-add-section">+ Ajouter une
                                section</button>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Compteur pour les sections
            let sectionCounter = 1;

            // Ajout d'une section
            $('#btn-add-section').click(function() {
                let newSection = $('.section-item:first').clone();
                newSection.find('input, select').val('');
                newSection.find('.btn-remove-section').show();

                // Mise à jour des noms des champs si besoin (ex: nom[1], nom[2]...)
                newSection.find('[name]').each(function() {
                    let name = $(this).attr('name').replace(/\[\d+\]/, '[' + sectionCounter + ']');
                    $(this).attr('name', name);
                });

                $('.section-item:last').after(newSection);
                sectionCounter++;
            });


            // Suppression d'un avocat
            $(document).on('click', '.btn-remove-section', function() {
                if ($('.section-item').length > 1) {
                    $(this).closest('.section-item').remove();
                }
            });
        });
    </script>
@endsection
