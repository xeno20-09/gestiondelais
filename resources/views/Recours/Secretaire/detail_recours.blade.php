@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title font-weight-bold mb-4">Détails du recours</h4>
                <p class="text-muted mb-4">Informations détaillées concernant le dossier de recours.</p>

                <div class="d-flex flex-wrap border-bottom py-3 justify-content-between">
                    <div>
                        <h5 class="mb-1">Numéro du dossier</h5>
                        <p class="text-muted">{{ $recours->numero_dossier ?? 'Non renseigné' }}</p>
                    </div>
                    <div>
                        <h5 class="mb-1">Affaire</h5>
                        <p class="text-muted">Requerant {{ $recours->partie->requerant->nom_complet ?? 'Non renseigné' }}</p>
                        <p class="text-muted">Reprensenter par:
                            {{ $recours->partie->avocats_requerants->nom_complet ?? 'Non renseigné' }}</p>
                        <p class="text-muted">Defendeur{{ $recours->partie->defendeur->nom_complet ?? 'Non renseigné' }}</p>
                        <p class="text-muted">Reprensenter
                            par:{{ $recours->partie->avocats_defendeurs->nom_complet ?? 'Non renseigné' }}</p>
                    </div>
                    <div>
                        <h5 class="mb-1">Date d’enregistrement</h5>
                        <p class="text-muted">
                            {{ \Carbon\Carbon::parse($recours->date_enregistrement)->format('d/m/Y') ?? 'Non renseigné' }}
                        </p>
                    </div>
                    <div>
                        <h5 class="mb-1">Objet</h5>
                        <p class="text-muted">{{ $recours->objet->nom ?? 'Non renseigné' }}</p>
                    </div>
                    <div>
                        <h5 class="mb-1">État du dossier</h5>
                        <p class="text-muted">{{ $recours->etat_dossier ?? 'Non renseigné' }}</p>
                    </div>
                </div>

                <div class="d-flex flex-wrap border-bottom py-3 justify-content-between">
                    <div>
                        <h5 class="mb-1">Structure liée</h5>
                        <p class="text-muted">{{ $recours->structure->nom_structure ?? 'Non renseigné' }}</p>
                    </div>
                    <div>
                        <h5 class="mb-1">Section liée</h5>
                        <p class="text-muted">{{ $recours->section->nom_section ?? 'Non renseigné' }}</p>
                    </div>
                    <div>
                        <h5 class="mb-1">Membres</h5>
                        <p class="text-muted">
                            Conseiller : {{ $recours->partie->conseiller->nom ?? 'Non renseigné' }}
                            {{ $recours->partie->conseiller->prenoms ?? 'Non renseigné' }}
                        </p>
                        <p class="text-muted">
                            Auditeur : {{ $recours->partie->auditeur->nom ?? 'Non renseigné' }}
                            {{ $recours->partie->auditeur->prenoms ?? 'Non renseigné' }}
                        </p>
                        <p class="text-muted">
                            Greffier : {{ $recours->partie->greffier->nom ?? 'Non renseigné' }}
                            {{ $recours->partie->greffier->prenoms ?? 'Non renseigné' }}
                        </p>
                    </div>
                    <div>
                        <h5 class="mb-1">Dernière instruction</h5>
                        <p class="text-muted">
                            {{ $recours->lastMouvement->instruction->nom ?? 'Aucune instruction' }}
                        </p>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
