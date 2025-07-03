<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use App\Models\UserRole;
use App\Models\Structure;
use App\Models\UserTitre;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function home()
    {
        $users = User::paginate(10);
        return view('Recours.Admin.listeusers', compact('users'));
    }
    public function change_mail(Request $request)
    {
        $user_info = User::find($request->id);
        $roles = UserRole::all();
        $titres = UserTitre::all();
        $structures = Structure::all();
        $sections = Section::all();
        return view('Recours.Admin.reset_user_info', compact('user_info', 'roles', 'titres', 'structures', 'sections'));
    }
    public function post_form_modify_info(Request $request)
    {
        $userline = User::find($request->id);
        $userline->nom = $request->nom;
        $userline->prenoms = $request->prenoms;
        $userline->email = $request->email;
        $userline->role = $request->role;
        $userline->titre = $request->titre;
        $userline->structure_id = $request->structure;
        $userline->section_id = $request->section;
        $userline->update();
        return redirect()->route('liste_users');
    }
    public function user_destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect()->route('liste_users');
    }
}
