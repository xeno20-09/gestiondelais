<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Recours;
use App\Models\Mouvement;
use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConseillerController extends Controller
{

    public function home()
    {
        return view('Recours.Conseiller.home');
    }
    public function getlisterecours_a_instruires()
    {
        $chambre = Auth::user()->structure_id;
        $pre_recours = Recours::where('etat_dossier', 'Affecté')->where('structure_id', $chambre)->orderby('created_at', 'desc')->get();
        $recours = [];

        foreach ($pre_recours as $value) {
            $partie = $value->partie;
            $conseiller_id = $partie->conseiller_id;

            if (Auth::user()->id == $conseiller_id) {
                $recours[] = $value;
            }
        }
        return view('Recours.Conseiller.listerecoursa_instruire', compact('recours'));
    }
    public function getformrecours_a_instruire(Request $request)
    {
        $id = $request->id;
        $recours = Recours::find($id);
        $mesures_intructions = Instruction::all();
        return view('Recours.Conseiller.form_recoursa_instruire', compact('recours', 'mesures_intructions'));
    }
    public function postformrecours_a_instruire(Request $request)
    {
        $recours = Recours::where('numero_dossier', $request->dossier_numero)->first();
        $recours->etat_dossier = 'A Instruire';
        $recours->update();
        $mouvement = new Mouvement;
        $mouvement->recours_id = $recours->id;
        $mouvement->instruction_id = $request->mesure;
        $mouvement->communique_au = $request->partie_concernee;
        $mouvement->date_debut_instruction = Carbon::now();
        $mouvement->etat_instruction = "Initiée";
        $mouvement->save();
        return redirect()->route('get_liste');
    }
}
