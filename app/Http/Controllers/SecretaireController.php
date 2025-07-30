<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Objet;
use App\Models\Partie;
use App\Models\Recours;
use App\Models\Defendeur;
use App\Models\Mouvement;
use App\Models\Requerant;
use App\Models\Structure;
use Illuminate\Http\Request;
use App\Models\AvocatDefendeur;
use App\Models\AvocatRequerant;
use App\Mail\RecoursInitPresident;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        $avocat_defendeur->email = $request->email_avocat_defendeur;
        $avocat_defendeur->save();

        $avocat_requerant = new AvocatRequerant;
        $avocat_requerant->nom_complet = $request->nom_avocat_requerant;
        $avocat_requerant->type = $request->type_avocat_requerant;
        $avocat_requerant->email = $request->email_avocat_requerant;
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
        if ($request->chambre_id == 1) {
            $president = User::where('email', 'pca@gmail.com')->get()[0];
        } else {
            $president = User::where('email', 'pcj@gmail.com')->get()[0];
        }

        Mail::to('allegressecakpo93@gmail.com')->send(
            new RecoursInitPresident($president, $recours)
        );
        return redirect()->route('get_liste');
    }
    public function getlisterecours()
    {
        if (Auth::user()->role == 'CONSEILLER') {
            $recours = Recours::whereHas('partie', function ($query) {
                $query->where('conseiller_id', Auth::user()->id);
            })->get();
        } elseif (Auth::user()->role == 'GREFFIER') {
            $recours = Recours::whereHas('partie', function ($query) {
                $query->where('greffier_id', Auth::user()->id);
            })->get();
        } elseif (Auth::user()->role == 'SECRETAIRE' || Auth::user()->titre == 'PRESIDENT DE STRUCTURE') {
            $recours = Recours::where('structure_id', Auth::user()->structure_id)->orderBy('created_at', 'desc')->get();
        } else {
            $recours = Recours::orderBy('created_at', 'desc')->get();
        }

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

    public function changepwdview()
    {
        $user = Auth::user();
        return view('auth.passwords.changepassword', compact('user'));
    }
    public function change_pwd(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Le nouveau mot de passe ne peut pas être identique à l\'ancien.');
        } else {

            $user->password = Hash::make($request->password);
            $user->update();
            Auth::logout();
            return redirect('/');
        }
    }
    public function formulaire_recours_update(Request $request){
        $objets = Objet::all();
        $recours=Recours::find($request->id);
        return view('Recours.Secretaire.form_mj_recours', ['recours' =>$recours , 'objets' => $objets]);
    }

    public function formulaire_recours_update_post(Request $request)
    {
        $recours=Recours::find($request->id);
    //dd($recours,$recours->partie->defendeur);

        $recours->numero_dossier = $request->dossier_numero;
        $recours->date_enregistrement = $request->date_enregistrement;
        $recours->structure_id = $request->chambre_id;
        $recours->objet_id = $request->objet_id;
        $recours->etat_dossier = 'Nouveau';
        $recours->update();

        $avocat_defendeur =$recours->partie->avocats_defendeurs;
        $avocat_defendeur->nom_complet = $request->nom_avocat_defendeur;
        $avocat_defendeur->type = $request->type_avocat_defendeur;
        $avocat_defendeur->email = $request->email_avocat_defendeur;
        $avocat_defendeur->update();

        $avocat_requerant = $recours->partie->avocats_requerants;
        $avocat_requerant->nom_complet = $request->nom_avocat_requerant;
        $avocat_requerant->type = $request->type_avocat_requerant;
        $avocat_requerant->email = $request->email_avocat_requerant;
        $avocat_requerant->update();

        $defendeur =$recours->partie->defendeur;
        $defendeur->nom_complet = $request->nom_defendeur;
        $defendeur->domicile = $request->domicile_defendeur;
        $defendeur->type_personne = $request->type_defendeur;
        $defendeur->update();

        $requerant = $recours->partie->requerant;
        $requerant->nom_complet = $request->nom_requerant;
        $requerant->domicile = $request->domicile_requerant;
        $requerant->type_personne = $request->type_requerant;
        $requerant->update();

        return redirect()->route('get_liste');
    }
}
