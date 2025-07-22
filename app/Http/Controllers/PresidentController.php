<?php

namespace App\Http\Controllers;

use App\Models\Recours;
use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresidentController extends Controller
{
    //
    public function home()
    {
        $chambre = Auth::user()->structure_id;
        $recours = Recours::where('etat_dossier', 'Nouveau')->where('structure_id', $chambre)->get();
        $countrecours = count($recours);
        return view('Recours.President.home', compact('recours', 'countrecours'));
    }
    public function getlisterecours_a_affectes()
    {
        $chambre = Auth::user()->structure_id;
        $recours = Recours::where('etat_dossier', 'Nouveau')->where('structure_id', $chambre)->get();
        $countrecours = count($recours);
        return view('Recours.President.listerecoursa_affectes', compact('recours', 'countrecours'));
    }

    public function getformrecours_a_affecte(Request $request)
    {
        $id = $request->id;
        $recours = Recours::find($id);
        $chambre = Auth::user()->structure_id;
        $countrecours = count(Recours::where('etat_dossier', 'Nouveau')->where('structure_id', $chambre)->get());
        return view('Recours.President.form_recoursa_affecte', compact('recours', 'countrecours'));
    }

    public function getmembre(Request $request)
    {
        /*         if (Auth::user()->titre == 'PRESIDENT DE STRUCTURE') {
 */
        $section = $request->input('section');
        $structure_info = Auth::user()->structure_id;
        $members_greffier = User::/* where('section_id', $section)-> */where('structure_id', $structure_info)->where('role', 'GREFFIER')->get();
        $members_auditeur = User::/* where('section_id', $section)-> */where('structure_id', $structure_info)->where('role', 'AUDITEUR')->get();
        $members_conseiller = User::/* where('section_id', $section)-> */where('structure_id', $structure_info)->where('role', 'CONSEILLER')->get();
        if ($section == 4 || $section == 8) {
            $members_conseiller = User::where('section_id', $section)->where('titre', 'PRESIDENT DE STRUCTURE')->get();
        }

        if ($members_greffier) {
            return response()->json(['greffiervaleurs' => $members_greffier, 'conseillervaleurs' => $members_conseiller, 'auditeurvaleurs' => $members_auditeur]);
        } else {
            return response()->json(['greffiervaleurs' => null, 'conseillervaleurs' => null, 'auditeurvaleurs' => null]);
        }
        /*     } else {
            return redirect()->route('unauthorized');
        } */
    }

    public function postformrecours_a_affecte(Request $request)
    {
        $recours = Recours::where('numero_dossier', $request->dossier_numero)->first();
        $recours->section_id = $request->section;
        $recours->etat_dossier = 'Affecté';
        $recours->update();
        $partie = $recours->partie;
        $partie->greffier_id = $request->greffier;
        $partie->conseiller_id = $request->conseiller;
        $partie->auditeur_id = $request->auditeur;
        $partie->update();
        return redirect()->route('get_liste');
    }

    public function getlisterecours_a_reaffectes(Request $request)
    {
        /*        if (Auth::user()->titre != 'PRESIDENT DE STRUCTURE') {
            return redirect()->route('unauthorized');
        } else {*/
        $id = $request->id;
        $recours = Recours::find($id);
        return view('Recours.President.form_recoursa_reaffecte', compact('recours'));
        /*         }
 */
    }
    public function getmembrerefratore(Request $request)
    {
        /*    if (Auth::user()->titre != 'PRESIDENT DE STRUCTURE') {
            return redirect()->route('unauthorized');
        } else { */
        $section = $request->input('section');
        $structure_info = Auth::user()->structure_id;
        $members_greffier = User::/* where('section_id', $section)-> */where('structure_id', $structure_info)->where('role', 'GREFFIER')->get();
        $members_auditeur = User::/* where('section_id', $section)-> */where('structure_id', $structure_info)->where('role', 'AUDITEUR')->get();
        $members_conseiller = User::/* where('section_id', $section)-> */where('structure_id', $structure_info)->where('role', 'CONSEILLER')->get();
        if ($section == 4 || $section == 8) {
            $members_conseiller = User::where('section_id', $section)->where('titre', 'PRESIDENT DE STRUCTURE')->get();
        }

        if ($members_greffier) {
            return response()->json(['greffiervaleurs' => $members_greffier, 'conseillervaleurs' => $members_conseiller, 'auditeurvaleurs' => $members_auditeur]);
        } else {
            return response()->json(['greffiervaleurs' => null, 'conseillervaleurs' => null, 'auditeurvaleurs' => null]);
        }
        /*         }
 */
    }
    public function postformrecours_a_reaffectes(Request $request)
    {
        /*   if (Auth::user()->titre != 'PRESIDENT DE STRUCTURE') {
            return redirect()->route('unauthorized');
        } else { */
        $recours = Recours::where('numero_dossier', $request->dossier_numero)->first();

        $partie = $recours->partie;
        $partie->greffier_id = $request->greffier;
        $partie->conseiller_id = $request->conseiller;
        $partie->auditeur_id = $request->auditeur;
        $partie->update();
        return redirect()->route('get_liste');
    }
    /*     }
 */
}
