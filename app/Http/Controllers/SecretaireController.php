<?php

namespace App\Http\Controllers;

use App\Models\Objet;
use App\Models\Partie;
use App\Models\Recours;
use App\Models\Defendeur;
use App\Models\Requerant;
use App\Models\Structure;
use Illuminate\Http\Request;
use App\Models\AvocatDefendeur;
use App\Models\AvocatRequerant;

class SecretaireController extends Controller
{
    public function home()
    {
        return view('Recours.Secretaire.home', ['recours' => Recours::all()]);
    }

    public function formulaire_recours_creation()
    {
        $structures = Structure::all();
        $objets = Objet::all();
        return view('Recours.Secretaire.form_create_recours', ['chambres' => $structures, 'objets' => $objets]);
    }
    public function formulaire_recours_creation_post(Request $request)
    {
        //dd($request->all());

        $recours = new Recours;
        $recours->numero_dossier = $request->dossier_numero;
        $recours->date_enregistrement = $request->date_enregistrement;
        $recours->structure_id = $request->chambre_id;
        $recours->objet_id = $request->objet_id;
        $recours->etat_dossier = 'Nouveau';
        $recours->save();

        $avocat_defendeur = new AvocatDefendeur;
        $avocat_defendeur->nom_complet = $request->nom_avocat_defendeur;
        $avocat_defendeur->type = $request->type_avocat_defendeur;
        $avocat_defendeur->save();

        $avocat_requerant = new AvocatRequerant;
        $avocat_requerant->nom_complet = $request->nom_avocat_requerant;
        $avocat_requerant->type = $request->type_avocat_requerant;
        $avocat_requerant->save();

        $defendeur = new Defendeur;
        $defendeur->nom_complet = $request->nom_defendeur;
        $defendeur->domicile = $request->domicile_defendeur;
        $defendeur->type_personne = $request->type_defendeur;
        $defendeur->save();

        $requerant = new Requerant;
        $requerant->nom_complet = $request->nom_requerant;
        $requerant->domicile = $request->domicile_requerant;
        $requerant->type_personne = $request->type_requerant;
        $requerant->save();

        $partie = new Partie;
        $partie->recours_id = $recours->id;
        $partie->avocat_defendeur_id = $avocat_defendeur->id;
        $partie->avocat_requerant_id = $avocat_requerant->id;
        $partie->requerant_id = $requerant->id;
        $partie->defendeur_id = $defendeur->id;
        $partie->save();
        return redirect()->route('get_liste');
    }
    public function getlisterecours()
    {
        $recours = Recours::all();

        return view('Recours.Secretaire.liste_recours', compact('recours'));
    }
    public function getdetailrecours(Request $request)
    {
        $recours = Recours::find($request->id);
        return view('Recours.Secretaire.detail_recours', compact('recours'));
    }

    public function gethistoryrecours(Request $request)
    {
        $recours = Recours::find($request->id);
        return view('Recours.Secretaire.historiquerecours', compact('recours'));
    }
}
