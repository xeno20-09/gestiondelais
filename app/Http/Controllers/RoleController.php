<?php

namespace App\Http\Controllers;

//use App\Models\role;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreroleRequest;
use App\Http\Requests\UpdateroleRequest;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('Recours.Admin.Parametres.Roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();

        return view('Recours.Admin.Parametres.Roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $permissionsID = array_map(
            function ($value) {
                return (int)$value;
            },
            $request->input('permissions')
        );

        $role = Role::create(['name' => $request->input('nom')]);
        $role->syncPermissions($permissionsID);

        /* $role = new UserRole();
        $role->nom = $request->nom;
        $role->save(); */
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
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('Recours.Admin.Parametres.Roles.update', ['role' => $role, 'rolePermissions' => $rolePermissions, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->input('nom');
        $role->update();

        $permissionsID = array_map(
            function ($value) {
                return (int)$value;
            },
            $request->input('permissions')
        );

        $role->syncPermissions($permissionsID);

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();        
        return redirect()->route('roles.index');
    }
}
