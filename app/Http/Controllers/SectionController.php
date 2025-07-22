<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Structure;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view('Recours.Admin.Parametres.Sections.index', ['sections' => $sections]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $structures = Structure::all();
        return view('Recours.Admin.Parametres.Sections.create', ['structures' => $structures]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        for ($i = 0; $i < count($request->nom); $i++) {
            $section = new Section();
            $section->structure_id = $request->structure_id;
            $section->nom_section = $request->nom[$i];
            $section->code_section = $request->code[$i];
            $section->save();
        }

        return redirect()->route('sections.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        $structures = Structure::all();
        return view('Recours.Admin.Parametres.Sections.update', ['structures' => $structures, 'section' => $section]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {

        $section->nom_section = $request->nom;
        $section->code_section = $request->code;
        $structure = Structure::where('nom_structure', $request->nom_structure)->first()->id;
        $section->structure_id = $structure;
        $section->update();
        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index');
    }
}
