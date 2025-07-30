@extends('layouts.header')

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Modification du recours</h4>

            <form method="POST" action="{{ route('form.recours.update.post', $recours->id) }}">
                @csrf
                @method('PUT')
                
                  <input type="hidden" name="id" class="form-control" 
       value="{{ $recours->id }}" />

                <p class="card-description">Information du dossier</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Numéro du dossier</label>
                            <div class="col-sm-9">
                                <input type="text" name="dossier_numero" class="form-control" 
                                    value="{{ old('dossier_numero', $recours->numero_dossier) }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date d'enregistrement</label>
                            <div class="col-sm-9">
                                <input type="date" name="date_enregistrement" class="form-control" 
                                    value="{{ old('date_enregistrement', $recours->date_enregistrement) }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Objet</label>
                            <div class="col-sm-9">
                                <select name="objet_id" class="form-control">
                                    @foreach ($objets as $item)
                                        <option value="{{ $item->id }}" 
                                            {{ $recours->objet_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Chambre</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" 
                                    value="{{ Auth::user()->structure->nom_structure }}" readonly />
                                <input type="hidden" name="chambre_id" value="{{ Auth::user()->structure->id }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Partie Requérant --}}
                <p class="card-description">Information du réquerant</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Type du réquerant</label>
                            <div class="col-sm-9">
                                <select name="type_requerant" class="form-control">
                                    <option value="">---Sélectionner---</option>
                                    <option value="Morale" {{ $recours->partie->requerant->type_personne == 'Morale' ? 'selected' : '' }}>Personne Morale</option>
                                    <option value="Physique" {{ $recours->partie->requerant->type_personne == 'Physique' ? 'selected' : '' }}>Personne Physique</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row requerant">
                            <label class="col-sm-3 col-form-label">Nom complet</label>
                            <div class="col-sm-9">
                                <input type="text" name="nom_requerant" class="form-control"
                                    value="{{ old('nom_requerant', $recours->partie->requerant->nom_complet) }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row requerant">
                            <label class="col-sm-3 col-form-label">Domicile</label>
                            <div class="col-sm-9">
                                <input type="text" name="domicile_requerant" class="form-control"
                                    value="{{ old('domicile_requerant', $recours->partie->requerant->domicile) }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Type d'avocat</label>
                            <div class="col-sm-9">
                                <select name="type_avocat_requerant" class="form-control">
                                    <option value="">---Sélectionner---</option>
                                    <option value="avocat_individuel" {{ $recours->partie->avocats_requerants->type == 'avocat_individuel' ? 'selected' : '' }}>Avocat individuel</option>
                                    <option value="avocat_conseil" {{ $recours->partie->avocats_requerants->type == 'avocat_conseil' ? 'selected' : '' }}>Conseil</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row avocat">
                            <label class="col-sm-3 col-form-label">Nom avocat</label>
                            <div class="col-sm-9">
                                <input type="text" name="nom_avocat_requerant" class="form-control"
                                    value="{{ old('nom_avocat_requerant',  $recours->partie->avocats_requerants->nom_complet) }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row avocat">
                            <label class="col-sm-3 col-form-label">Email avocat</label>
                            <div class="col-sm-9">
                                <input type="email" name="email_avocat_requerant" class="form-control"
                                    value="{{ old('email_avocat_requerant', $recours->partie->avocats_requerants->email) }}" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Partie Défendeur --}}
                <p class="card-description">Information du défendeur</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Type défendeur</label>
                            <div class="col-sm-9">
                                <select name="type_defendeur" class="form-control">
                                    <option value="">---Sélectionner---</option>
                                    <option value="Morale" {{ $recours->partie->defendeur->type_personne == 'Morale' ? 'selected' : '' }}>Personne Morale</option>
                                    <option value="Physique" {{ $recours->partie->defendeur->type_personne == 'Physique' ? 'selected' : '' }}>Personne Physique</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row requerant">
                            <label class="col-sm-3 col-form-label">Nom complet</label>
                            <div class="col-sm-9">
                                <input type="text" name="nom_defendeur" class="form-control"
                                    value="{{ old('nom_defendeur', $recours->partie->defendeur->nom_complet) }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row requerant">
                            <label class="col-sm-3 col-form-label">Domicile</label>
                            <div class="col-sm-9">
                                <input type="text" name="domicile_defendeur" class="form-control"
                                    value="{{ old('domicile_defendeur', $recours->partie->defendeur->domicile) }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Type d'avocat</label>
                            <div class="col-sm-9">
                                <select name="type_avocat_defendeur" class="form-control">
                                    <option value="">---Sélectionner---</option>
                                    <option value="avocat_individuel" {{ $recours->partie->avocats_defendeurs->type == 'avocat_individuel' ? 'selected' : '' }}>Avocat individuel</option>
                                    <option value="avocat_conseil" {{ $recours->partie->avocats_defendeurs->type == 'avocat_conseil' ? 'selected' : '' }}>Conseil</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row avocat">
                            <label class="col-sm-3 col-form-label">Nom avocat</label>
                            <div class="col-sm-9">
                                <input type="text" name="nom_avocat_defendeur" class="form-control"
                                    value="{{ old('nom_avocat_defendeur', $recours->partie->avocats_defendeurs->nom_complet) }}" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row avocat">
                            <label class="col-sm-3 col-form-label">Email avocat</label>
                            <div class="col-sm-9">
                                <input type="email" name="email_avocat_defendeur" class="form-control"
                                    value="{{ old('email_avocat_defendeur', $recours->partie->avocats_defendeurs->email) }}" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button class="btn btn-success">Mettre à jour</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
