<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<!-- [HEAD reste identique] -->

<body class="bg-red-100"
    style="outline: 0; width: 100%; min-width: 100%; height: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: Helvetica, Arial, sans-serif; line-height: 24px; font-weight: normal; font-size: 16px; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box; color: #000000; margin: 0; padding: 0; border-width: 0;"
    bgcolor="#fff">
    <!-- [STRUCTURE GLOBALE IDENTIQUE] -->

    <div class="space-y-4">
        <h1 class="text-4xl fw-800"
            style="padding-top: 0; padding-bottom: 0; font-weight: 800 !important; vertical-align: baseline; font-size: 36px; line-height: 43.2px; margin: 0;"
            align="left">Bonjour,@if ($user->sexe == 'Homme')
                @php $genre = 'Mr'; @endphp
            @else
                @php $genre = 'Mme'; @endphp
            @endif {{ $genre }}
            {{ $user->nom }} {{ $user->prenoms }} {{ $user->role }}
            de la {{ $recours->structure->nom_structure }}</h1>

        <table class="s-4 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"
            width="100%">
            <tbody>
                <tr>
                    <td style="line-height: 16px; font-size: 16px; width: 100%; height: 16px; margin: 0;" align="left"
                        width="100%" height="16">
                        &#160;
                    </td>
                </tr>
            </tbody>
        </table>

        <p class="" style="line-height: 24px; font-size: 16px; width: 100%; margin: 0;" align="left">
            @if ($recours->lastMouvement->instruction->nom == 'Paiement de consignation')
                Nous vous informons que le <strong>paiement de consignation</strong> concernant le dossier
                <strong>{{ $recours->numero_dossier }}</strong> a été effectué avec succès.
                <br><br>
                <strong>Le dossier est désormais clos</strong> et ne nécessite plus aucune action de votre part.
            @else
                Nous vous informons que le contact a bien été établi pour la
                mesure d'instruction <strong>{{ $recours->lastMouvement->instruction->nom }}</strong>
                concernant le dossier <strong>{{ $recours->numero_dossier }}</strong>,
                mais que celle-ci n'a pas été exécutée dans les délais impartis.
            @endif
        </p>

        @if ($recours->lastMouvement->instruction->nom != 'Paiement de consignation')
            <p style="line-height: 24px; font-size: 16px; width: 100%; margin: 10px 0 0 0;" align="left">
                L'instruction avait été initiée le
                <strong>{{ \Carbon\Carbon::parse($recours->lastMouvement->date_debut_instruction)->locale('fr_FR')->isoFormat('dddd D MMM Y') }}</strong>
                avec une échéance prévue pour le
                <strong>{{ \Carbon\Carbon::parse($recours->lastMouvement->date_fin_instruction)->locale('fr_FR')->isoFormat('dddd D MMM Y') }}</strong>.
            </p>
            <p style="line-height: 24px; font-size: 16px; width: 100%; margin: 10px 0 0 0;" align="left">
                Le requérant <strong>{{ $recours->partie->requerant->nom_complet }}</strong>
                avait été notifié le
                <strong>{{ \Carbon\Carbon::parse($recours->lastMouvement->date_debut_notification)->locale('fr_FR')->isoFormat('dddd D MMM Y') }}</strong>,
                mais n'a pas donné suite dans les délais requis.
            </p>
        @endif

        <!-- [RESTE DU CODE IDENTIQUE] -->
    </div>

    <!-- [TABLEAU DES DÉTAILS] -->
    <table class="card rounded-3xl px-4 py-8 p-lg-10" role="presentation" border="0" cellpadding="0" cellspacing="0"
        style="border-radius: 24px; border-collapse: separate !important; width: 100%; overflow: hidden; border: 1px solid #e2e8f0;"
        bgcolor="#ffffff">
        <tbody>
            <tr>
                <td style="line-height: 24px; font-size: 16px; width: 100%; border-radius: 24px; margin: 0; padding: 40px;"
                    align="left" bgcolor="#ffffff">
                    <h3 class="text-center"
                        style="padding-top: 0; padding-bottom: 0; font-weight: 500; vertical-align: baseline; font-size: 28px; line-height: 33.6px; margin: 0;"
                        align="center">
                        Détails du dossier
                    </h3>

                    <table class="p-2 w-full" border="0" cellpadding="0" cellspacing="0" style="width: 100%;"
                        width="100%">
                        <!-- [INFORMATIONS DU DOSSIER IDENTIQUES] -->

                        @if ($recours->lastMouvement->instruction->nom == 'Paiement de consignation')
                            <tr>
                                <td colspan="2"
                                    style="padding: 15px 8px; text-align: center; background-color: #f0fff0;">
                                    <strong style="color: #2e7d32;">STATUT : DOSSIER CLOS</strong>
                                </td>
                            </tr>
                        @endif
                    </table>

                    <!-- [RESTE DU CODE IDENTIQUE] -->
                </td>
            </tr>
        </tbody>
    </table>

    <!-- [PIED DE PAGE IDENTIQUE] -->
</body>

</html>
