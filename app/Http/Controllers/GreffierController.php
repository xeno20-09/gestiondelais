<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Recours;
use App\Models\Mouvement;
use App\Models\Instruction;
use Illuminate\Http\Request;
use App\Mail\FirstMailInstruction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class GreffierController extends Controller
{

    public function home()
    {
        return view('Recours.Greffier.home');
    }
    public function getlisterecours_en_instructions()
    {
        $chambre = Auth::user()->structure_id;
        $pre_recours = Recours::where('etat_dossier', 'A Instruire')->where('structure_id', $chambre)->get();
        $recours = [];
        foreach ($pre_recours as $value) {
            $mouvement = $value->lastMouvement;
            if ($mouvement && $mouvement->etat_instruction == 'Initiée') {
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
                    ->addDays($get_instruction->delais);
                $lastmouvement->observation = $request->observation;
                $lastmouvement->update();

                Mail::to($partie->greffier->email)->send(
                    new FirstMailInstruction(
                        $recours,
                        $partie->greffier,
                    )
                );
                Mail::to($partie->conseiller->email)->send(
                    new FirstMailInstruction(
                        $recours,
                        $partie->conseiller,
                    )
                );
                Mail::to($partie->auditeur->email)->send(
                    new FirstMailInstruction(
                        $recours,
                        $partie->auditeur,
                    )
                );
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
                $recours->etat_dossier = 'Affecté';
                $recours->update();
                $partie = $recours->partie;
                $lastmouvement = $recours->lastMouvement;
                $get_instruction = Instruction::where('nom', $request->instruction)->first();
                if ($get_instruction->id == $lastmouvement->instruction->id) {
                    $lastmouvement->etat_instruction = "Inachevée";
                    $lastmouvement->observation = $request->observation;
                    $lastmouvement->update();

                    Mail::to($partie->greffier->email)->send(
                        new FirstMailInstruction(
                            $recours,
                            $partie->greffier,
                        )
                    );
                    Mail::to($partie->conseiller->email)->send(
                        new FirstMailInstruction(
                            $recours,
                            $partie->conseiller,
                        )
                    );
                    Mail::to($partie->auditeur->email)->send(
                        new FirstMailInstruction(
                            $recours,
                            $partie->auditeur,
                        )
                    );
                }
            }
        }
        return redirect()->route('get_liste');
    }
}
