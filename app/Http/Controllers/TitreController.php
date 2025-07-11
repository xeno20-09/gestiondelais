<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use App\Models\UserTitre;
use Illuminate\Http\Request;

class TitreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titres = UserTitre::all();
        return view('Recours.Admin.Parametres.Titres.index', ['titres' => $titres]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('Recours.Admin.Parametres.Titres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $titre = new UserTitre();
        $titre->nom = $request->nom;
        $titre->save();
        return redirect()->route('titres.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserTitre $titre)
    {
        return view('Recours.Admin.Parametres.Titres.update', ['titre' => $titre]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserTitre $titre)
    {
        $titre->nom = $request->nom;
        $titre->update();
        return redirect()->route('titres.index');  //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserTitre $titre)
    {
        $titre->delete();
        return redirect()->route('titres.index');
    }
}
