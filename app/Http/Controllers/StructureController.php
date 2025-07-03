<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structures = Structure::all();
        return view('Recours.Admin.Parametres.Structures.index', ['structures' => $structures]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Recours.Admin.Parametres.Structures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $structure = new Structure();
        $structure->nom_structure = $request->nom;
        $structure->code_structure = $request->code;
        $structure->save();
        return redirect()->route('structures.index');
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
    public function edit(Structure $structure)
    {
        return view('Recours.Admin.Parametres.Structures.update', ['structure' => $structure]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Structure $structure)
    {
        $structure->nom_structure = $request->nom;
        $structure->code_structure = $request->code;
        $structure->update();
        return redirect()->route('structures.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Structure $structure)
    {
        $structure->delete();
        return redirect()->route('structures.index');
    }
}
