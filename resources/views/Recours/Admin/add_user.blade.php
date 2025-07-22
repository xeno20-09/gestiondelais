@extends('layouts.header')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Inscription') }}</div>

                    <div class="card-body">
                        @can('user-create')
                            <form method="POST" action="{{ route('post.user') }}">
                                @csrf

                                {{-- Nom --}}
                                <div class="row mb-3">
                                    <label for="nom" class="col-md-4 col-form-label text-md-end">Nom</label>
                                    <div class="col-md-6">
                                        <input id="nom" type="text"
                                            class="form-control @error('nom') is-invalid @enderror" name="nom" required
                                            autofocus>
                                        @error('nom')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Prénoms --}}
                                <div class="row mb-3">
                                    <label for="prenoms" class="col-md-4 col-form-label text-md-end">Prénoms</label>
                                    <div class="col-md-6">
                                        <input id="prenoms" type="text"
                                            class="form-control @error('prenoms') is-invalid @enderror" name="prenoms" required>
                                        @error('prenoms')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Rôle --}}
                                <div class="row mb-3">
                                    <label for="role_id" class="col-md-4 col-form-label text-md-end">Rôle</label>
                                    <div class="col-md-6">
                                        <select class="form-control @error('role_id') is-invalid @enderror" name="role"
                                            required>
                                            <option value="">-- Sélectionner le rôle --</option>
                                            @foreach ($roles as $item)
                                                <option value="{{ $item->nom }}">{{ $item->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Sexe --}}
                                <div class="row mb-3">
                                    <label for="sexe" class="col-md-4 col-form-label text-md-end">Sexe</label>
                                    <div class="col-md-6">
                                        <select class="form-control @error('sexe') is-invalid @enderror" name="sexe"
                                            required>
                                            <option value="">-- Sélectionner le sexe --</option>
                                            <option value="Femme">Femme</option>
                                            <option value="Homme">Homme</option>
                                        </select>
                                        @error('sexe')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Structure --}}
                                <div class="row mb-3">
                                    <label for="structure_id" class="col-md-4 col-form-label text-md-end">Structure</label>
                                    <div class="col-md-6">
                                        <select class="form-control @error('structure_id') is-invalid @enderror"
                                            name="structure_id" required>
                                            <option value="">-- Sélectionner la structure --</option>
                                            @foreach ($structures as $item)
                                                <option value="{{ $item->id }}">{{ $item->nom_structure }}</option>
                                            @endforeach
                                        </select>
                                        @error('structure_id')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Section --}}
                                <div class="row mb-3">
                                    <label for="section_id" class="col-md-4 col-form-label text-md-end">Section</label>
                                    <div class="col-md-6">
                                        <select class="form-control @error('section_id') is-invalid @enderror" name="section_id"
                                            required>
                                            <option value="">-- Sélectionner la section --</option>
                                            @foreach ($sections as $item)
                                                <option value="{{ $item->id }}">{{ $item->nom_section }}</option>
                                            @endforeach
                                        </select>
                                        @error('section_id')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Titre --}}
                                <div class="row mb-3">
                                    <label for="titre_id" class="col-md-4 col-form-label text-md-end">Titre</label>
                                    <div class="col-md-6">
                                        <select class="form-control @error('titre_id') is-invalid @enderror" name="titre"
                                            required>
                                            <option value="">-- Sélectionner le titre --</option>
                                            @foreach ($titres as $item)
                                                <option value="{{ $item->nom }}">{{ $item->nom }}</option>
                                            @endforeach
                                        </select>
                                        @error('titre_id')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Adresse e-mail</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email" required>
                                        @error('email')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Mot de passe --}}
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">Mot de passe</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required>
                                        @error('password')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Confirmation du mot de passe --}}
                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirmer le mot
                                        de passe</label>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required>
                                    </div>
                                </div>

                                {{-- Bouton de soumission --}}
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            S'inscrire
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
