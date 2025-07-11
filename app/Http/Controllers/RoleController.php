<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Http\Requests\StoreroleRequest;
use App\Http\Requests\UpdateroleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = UserRole::all();
        return view('Recours.Admin.Parametres.Roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Recours.Admin.Parametres.Roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = new UserRole();
        $role->nom = $request->nom;
        $role->save();
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserRole $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserRole $role)
    {
        return view('Recours.Admin.Parametres.Roles.update', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserRole $role)
    {
        $role->nom = $request->nom;
        $role->update();
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserRole $role)
    {
        $role->delete();
        return redirect()->route('roles.index');
    }
}
