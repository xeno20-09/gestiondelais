<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use Illuminate\Http\Request;

class MesureInstructionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructions = Instruction::all();
        return view('Recours.Conseiller.Instructions.crud.read', ['instructions' => $instructions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Recours.Conseiller.Instructions.crud.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $instruction = new Instruction();
        $instruction->nom = $request->description;
        $instruction->delais = $request->delais;
        $instruction->save();
        return redirect()->route('mesure_instructions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instruction $instruction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instruction $instruction)
    {
        return view('Recours.Conseiller.Instructions.crud.update', ['instruction' => $instruction]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instruction $instruction)
    {
        $instruction->nom = $request->description;
        $instruction->delais = $request->delais;
        $instruction->save();
        return redirect()->route('mesure_instructions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instruction $instruction)
    {
        $instruction->delete();
        return redirect()->route('mesure_instructions.index');
    }
}
