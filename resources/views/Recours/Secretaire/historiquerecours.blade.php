@extends('layouts.header')
@section('content')
    <div class="col-12 grid-margin">
        <style>
            .timeline {
                position: relative;
                padding: 20px 0;
                list-style: none;
            }

            .timeline::before {
                content: '';
                position: absolute;
                left: 30px;
                top: 0;
                bottom: 0;
                width: 2px;
                background: #3498db;
            }

            .timeline-item {
                position: relative;
                margin-bottom: 30px;
                padding-left: 60px;
            }

            .timeline-item::before {
                content: '';
                position: absolute;
                left: 22px;
                top: 5px;
                width: 16px;
                height: 16px;
                border-radius: 50%;
                background: #3498db;
            }

            .timeline-item h5 {
                margin-bottom: 5px;
                font-weight: bold;
            }

            .timeline-item small {
                color: #999;
            }

            .timeline-item p {
                margin: 5px 0;
            }
        </style>

        <div class="container">
            <h4 class="mb-4">Historique du recours</h4>
            <ul class="timeline">

                <li class="timeline-item">
                    <h5>Recours enregistré</h5>
                    <small>{{ \Carbon\Carbon::parse($recours->date_enregistrement)->locale('fr_FR')->isoFormat('dddd D MMMM Y à HH:mm') }}</small>
                    <p>Dossier soumis par le requérant.</p>
                </li>

                <li class="timeline-item">
                    <h5>Affecté à la section {{ $recours->section->nom_section ?? 'Non précisée' }}</h5>
                    <small>{{ $recours->created_at->locale('fr_FR')->isoFormat('dddd D MMMM Y à HH:mm') }}</small>
                    @if ($recours->partie->conseiller)
                        <p>Le président a affecté ce recours à une section.</p>
                    @else
                        <p>Le président n'a pas encore affecté de section à ce recours.</p>
                    @endif
                    <h5>Conseiller rapporteur : {{ $recours->partie->conseiller->nom ?? 'Non précisé' }}
                        {{ $recours->partie->conseiller->prenoms ?? '' }}</h5>
                    <h5>Auditeur : {{ $recours->partie->auditeur->nom ?? 'Non précisé' }}
                        {{ $recours->partie->auditeur->prenoms ?? '' }}</h5>
                    <h5>Greffier : {{ $recours->partie->greffier->nom ?? 'Non précisé' }}
                        {{ $recours->partie->greffier->prenoms ?? '' }}</h5>
                </li>

                @foreach ($recours->mouvements as $item)
                    <li class="timeline-item">
                        <h5>Instruction : {{ $item->instruction->nom }} ({{ $item->instruction->delais }} jours)</h5>
                        <small>{{ \Carbon\Carbon::parse($item->date_debut_notification)->locale('fr_FR')->isoFormat('dddd D MMM Y à HH:mm') }}</small>
                        →
                        <small>{{ \Carbon\Carbon::parse($item->date_fin_instruction)->locale('fr_FR')->isoFormat('dddd D MMM Y à HH:mm') }}</small>
                        <p>Instruction par {{ $recours->partie->conseiller->nom ?? 'Non précisé' }}
                            {{ $recours->partie->conseiller->prenoms ?? '' }}.</p>
                        <p>État : <small>{{ $item->etat_instruction ?? 'N/A' }}</small></p>
                    </li>
                @endforeach

                @if ($recours->etat_dossier === 'Clos')
                    <li class="timeline-item">
                        <h5>Dossier clôturé</h5>
                        <small>{{ \Carbon\Carbon::parse($recours->date_clos)->locale('fr_FR')->isoFormat('dddd D MMMM Y à HH:mm') }}</small>
                        <p>Instruction terminée, dossier archivé.</p>
                    </li>
                @endif

            </ul>

        </div>
    </div>
@endsection
