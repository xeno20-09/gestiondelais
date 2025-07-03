@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Formulaire d'enregistrement du recours</h4>
                <form class="form-sample" method="POST" action="{{ route('form.recours.create.post') }}">
                    @csrf
                    <p class="card-description">Information du dossier</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Numéro du dossier</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="dossier_numero" placeholder=""
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date d'enregistrement</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="date_enregistrement" required />
                                </div>
                            </div>
                        </div>

                        {{--         <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Objet</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="objet" placeholder="" required />
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chambre</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="chambre_id" required>
                                        @foreach ($chambres as $item)
                                            <option value="{{ $item->id }}">{{ $item->nom_structure }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>


                    <p class="card-description">Information du réquerant</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type du requerant</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="type_requerant" required>
                                        <option value="">---Faite une selection ---</option>
                                        <option value="Morale">Personne Morale</option>
                                        <option value="Physique">Personne Physique</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row requerant">
                                <label class="col-sm-3 col-form-label">Nom complet du réquerant</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nom_requerant" placeholder=""
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row requerant">
                                <label class="col-sm-3 col-form-label">Domicile du réquerant</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="domicile_requerant" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type de l'avocat</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="type_avocat_requerant" required>
                                        <option value="">---Faite une selection ---</option>
                                        <option value="avocat_individuel">Avocat individuel</option>
                                        <option value="avocat_conseil">Conseil</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row avocat">
                                <label class="col-sm-3 col-form-label">Nom de l'avocat/du conseil</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nom_avocat_requerant" placeholder=""
                                        required />
                                </div>
                            </div>
                        </div>
                    </div>


                    <p class="card-description">Information du défendeur</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type du défendeur</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="type_defendeur" required>
                                        <option value="">---Faite une selection ---</option>
                                        <option value="Morale">Personne Morale</option>
                                        <option value="Physique">Personne Physique</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row requerant">
                                <label class="col-sm-3 col-form-label">Nom complet du défendeur</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nom_defendeur" placeholder=""
                                        required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row requerant">
                                <label class="col-sm-3 col-form-label">Domicile du défendeur</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="domicile_defendeur" placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type de l'avocat</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="type_avocat_defendeur" required>
                                        <option value="">---Faite une selection ---</option>
                                        <option value="avocat_individuel">Avocat individuel</option>
                                        <option value="avocat_conseil">Conseil</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row avocat">
                                <label class="col-sm-3 col-form-label">Nom de l'avocat/du conseil</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nom_avocat_defendeur"
                                        placeholder="" required />
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button class="btn btn-primary">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
