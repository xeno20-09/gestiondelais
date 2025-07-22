<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Recours;
use App\Models\Mouvement;
use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\MailUserFinInstruction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\FirstMailUserInstruction;
use App\Mail\MailLawyerFinInstruction;
use App\Mail\FirstMailLawyerInstruction;
use App\Mail\MailUserInstructionInachevee;
use App\Mail\MailLawyerInstructionInachevee;

class GreffierController extends Controller
{

    public function home()
    {
        return view('Recours.Greffier.home');
    }
    public function getlisterecours_en_instructions()
    {
        $chambre = Auth::user()->structure_id;
        $pre_recours = Recours::where('etat_dossier', 'A Instruire')->orwhere('etat_dossier', 'En instruction')->where('structure_id', $chambre)->get();
        $recours = [];
        foreach ($pre_recours as $value) {
            $mouvement = $value->lastMouvement;
            if ($mouvement && ($mouvement->etat_instruction == 'Initiée' || $mouvement->etat_instruction == 'Contacté' || $mouvement->etat_instruction == 'Non Contacté')) {
                $greffier_id = $value->partie->greffier_id ?? null;
                if (Auth::user()->id == $greffier_id) {
                    $recours[] = $value;
                }
            }
        }
        return view('Recours.Greffier.listerecoursa_instruction', compact('recours'));
    }
    public function getformrecours_en_instruction(Request $request)
    {
        $id = $request->id;
        $recours = Recours::find($id);
        return view('Recours.Greffier.form_recoursen_instruction', compact('recours'));
    }

    public function postformrecours_en_instruction(Request $request)
    {
        if ($request->etat_instruction == 'Contacté') {
            $numero_dossier = $request->dossier_numero;
            $recours = Recours::where('numero_dossier', $numero_dossier)->first();
            $recours->etat_dossier = 'En instruction';
            $recours->update();
            $partie = $recours->partie;
            $lastmouvement = $recours->lastMouvement;
            $get_instruction = Instruction::where('nom', $request->instruction)->first();
            if ($get_instruction->id == $lastmouvement->instruction->id) {
                $lastmouvement->etat_instruction = "Contacté";
                $lastmouvement->date_debut_notification = $request->date_notification;
                $lastmouvement->date_fin_instruction = Carbon::parse($request->date_notification)
                    ->addDays($get_instruction->delais + 1);
                $lastmouvement->observation = $request->observation;
                $lastmouvement->update();
                // Envoi des mails avec gestion d'erreur
                try {
                    Mail::to('allegressecakpo93@gmail.com')->send(
                        new FirstMailUserInstruction($recours, $partie->conseiller)
                    );
                } catch (\Exception $e) {
                    Log::error("Erreur envoi mail au conseiller : " . $e->getMessage());
                }

                try {
                    Mail::to('adelecakpo150@gmail.com')->send(
                        new FirstMailUserInstruction($recours, $partie->auditeur)
                    );
                } catch (\Exception $e) {
                    Log::error("Erreur envoi mail à l'auditeur : " . $e->getMessage());
                }
                try {
                    Mail::to('allegressecakpo93@gmail.com')->send(
                        new FirstMailUserInstruction($recours, $partie->greffier)
                    );
                } catch (\Exception $e) {
                    Log::error("Erreur envoi mail au greffier : " . $e->getMessage());
                }

                if ($lastmouvement->communique_au == 'Deux parties') {

                    try {
                        Mail::to('allegressecakpo93@gmail.com')->send(
                            new FirstMailLawyerInstruction($recours, $partie->avocats_requerants)
                        );
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail a l'avocat requerant : " . $e->getMessage());
                    }

                    try {
                        Mail::to('adelecakpo150@gmail.com')->send(
                            new FirstMailLawyerInstruction($recours, $partie->avocats_defendeurs)
                        );
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail à l'avocat defendeur : " . $e->getMessage());
                    }
                } elseif ($lastmouvement->communique_au == 'Réquerant') {

                    try {
                        Mail::to('allegressecakpo93@gmail.com')->send(
                            new FirstMailLawyerInstruction($recours, $partie->avocats_requerants)
                        );
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail a l'avocat requerant : " . $e->getMessage());
                    }
                } elseif ($lastmouvement->communique_au == 'Défendeur') {
                    try {
                        Mail::to('adelecakpo150@gmail.com')->send(
                            new FirstMailLawyerInstruction($recours, $partie->avocats_defendeurs)
                        );
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail à l'avocat defendeur : " . $e->getMessage());
                    }
                }






                /*                 Mail::to($partie->greffier->email)->send(
                    new FirstMailInstruction(
                        $recours,
                        $partie->greffier,
                    )
                ); 
                Mail::to( $partie->conseiller->email )->send(
                    new FirstMailInstruction(
                        $recours,
                        $partie->conseiller,
                    )
                );
                Mail::to( $partie->auditeur->email)->send(
                    new FirstMailInstruction(
                        $recours,
                        $partie->auditeur,
                    )
                );*/
            }
        } elseif ($request->etat_instruction == 'Non Contacté') {
            $numero_dossier = $request->dossier_numero;
            $recours = Recours::where('numero_dossier', $numero_dossier)->first();
            $recours->update();
            $partie = $recours->partie;
            $lastmouvement = $recours->lastMouvement;
            $get_instruction = Instruction::where('nom', $request->instruction)->first();
            if ($get_instruction->id == $lastmouvement->instruction->id) {
                $lastmouvement->etat_instruction = "Non Contacté";
                $lastmouvement->observation = $request->observation;
                $lastmouvement->update();
            }
        } elseif ($request->etat_instruction == 'Inachevée') {

            $numero_dossier = $request->dossier_numero;
            $recours = Recours::where('numero_dossier', $numero_dossier)->first();
            $lastmouvement = $recours->lastMouvement;
            if ($lastmouvement->instruction->nom == 'Paiement de consignation') {
                $recours->etat_dossier = 'Clos';
                $recours->dossier_clos = true;
                $recours->date_clos = Carbon::now()->format('Y-m-d');
                $recours->observation="Recours clos suite au paiement de la consignation";
                $recours->update();
            } else {
                $recours->etat_dossier = 'Affecté';
                $recours->update();
            }

            $partie = $recours->partie;
            $get_instruction = Instruction::where('nom', $request->instruction)->first();

            if ($get_instruction->id == $lastmouvement->instruction->id) {
                $lastmouvement->etat_instruction = "Inachevée";
                $lastmouvement->observation = $request->observation;
                $lastmouvement->update();

                /*  Mail::to( $partie->greffier->email )->send(
                    new MailUserFinInstruction(
                        $recours,
                        $partie->greffier,
                    )
                ); */
                Mail::to(/* $partie->conseiller->email */'allegressecakpo93@gmail.com')->send(
                    new MailUserInstructionInachevee(
                        $recours,
                        $partie->conseiller,
                    )
                );
                Mail::to(/* $partie->auditeur->email */'adelecakpo150@gmail.com')->send(
                    new MailUserInstructionInachevee(
                        $recours,
                        $partie->auditeur,
                    )
                );

                if ($lastmouvement->communique_au == 'Deux parties') {

                    try {
                        Mail::to('allegressecakpo93@gmail.com')->send(
                            new MailLawyerInstructionInachevee($recours, $partie->avocats_requerants)
                        );
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail a l'avocat requerant : " . $e->getMessage());
                    }

                    try {
                        Mail::to('adelecakpo150@gmail.com')->send(
                            new MailLawyerInstructionInachevee($recours, $partie->avocats_defendeurs)
                        );
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail à l'avocat defendeur : " . $e->getMessage());
                    }
                } elseif ($lastmouvement->communique_au == 'Réquerant') {

                    try {
                        Mail::to('allegressecakpo93@gmail.com')->send(
                            new MailLawyerInstructionInachevee($recours, $partie->avocats_requerants)
                        );
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail a l'avocat requerant : " . $e->getMessage());
                    }
                } elseif ($lastmouvement->communique_au == 'Défendeur') {
                    try {
                        Mail::to('adelecakpo150@gmail.com')->send(
                            new MailLawyerInstructionInachevee($recours, $partie->avocats_defendeurs)
                        );
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail à l'avocat defendeur : " . $e->getMessage());
                    }
                }
            }
        } elseif ($request->etat_instruction == 'Executée') {

            $numero_dossier = $request->dossier_numero;
            $recours = Recours::where('numero_dossier', $numero_dossier)->first();
            $recours->etat_dossier = 'Affecté';
            $recours->update();
            $partie = $recours->partie;
            $lastmouvement = $recours->lastMouvement;
            $get_instruction = Instruction::where('nom', $request->instruction)->first();
            if ($get_instruction->id == $lastmouvement->instruction->id) {
                $lastmouvement->etat_instruction = "Executée";
                $lastmouvement->date_execution = \Carbon\Carbon::now()->format('Y-m-d');

                $lastmouvement->observation = $request->observation;
                $lastmouvement->update();

                /*  Mail::to( $partie->greffier->email )->send(
                    new MailUserFinInstruction(
                        $recours,
                        $partie->greffier,
                    )
                ); */
                Mail::to(/* $partie->conseiller->email */'allegressecakpo93@gmail.com')->send(
                    new MailUserFinInstruction(
                        $recours,
                        $partie->conseiller,
                    )
                );
                Mail::to(/* $partie->auditeur->email */'adelecakpo150@gmail.com')->send(
                    new MailUserFinInstruction(
                        $recours,
                        $partie->auditeur,
                    )
                );

                if ($lastmouvement->communique_au == 'Deux parties') {

                    try {
                        Mail::to('allegressecakpo93@gmail.com')->send(
                            new MailLawyerFinInstruction($recours, $partie->avocats_requerants)
                        );
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail a l'avocat requerant : " . $e->getMessage());
                    }

                    try {
                        Mail::to('adelecakpo150@gmail.com')->send(
                            new MailLawyerFinInstruction($recours, $partie->avocats_defendeurs)
                        );
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail à l'avocat defendeur : " . $e->getMessage());
                    }
                } elseif ($lastmouvement->communique_au == 'Réquerant') {

                    try {
                        Mail::to('allegressecakpo93@gmail.com')->send(
                            new MailLawyerFinInstruction($recours, $partie->avocats_requerants)
                        );
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail a l'avocat requerant : " . $e->getMessage());
                    }
                } elseif ($lastmouvement->communique_au == 'Défendeur') {
                    try {
                        Mail::to('adelecakpo150@gmail.com')->send(
                            new MailLawyerFinInstruction($recours, $partie->avocats_defendeurs)
                        );
                    } catch (\Exception $e) {
                        Log::error("Erreur envoi mail à l'avocat defendeur : " . $e->getMessage());
                    }
                }
            }
        }
        return redirect()->route('get_liste');
    }
}
