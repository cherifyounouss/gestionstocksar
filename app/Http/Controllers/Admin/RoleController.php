<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Controller;
// use App\Permission;
// use App\Role;
//Laravel Spatie Permission Handling
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where('name', '!=', 'admin')->get();
        return view('role.list')->with(compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Les permissions gerer role et gerer utilisateur ne peuvent pas etre donné a un nouvel utilisateur
        $permissions = Permission::where('name', '!=', 'gerer role')->where('name', '!=', 'gerer utilisateur')->get();
        return view('role.new')->with(compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {   
        //Validation du saisie
        $request->validated();
        //Recuperation des donnees saisies
        $data = $request->all();
        $role = new Role;
        $role->name = $data['nom_role'];
        //On specifie le guard name
        $role->guard_name = 'utilisateur';
        $role->save();
        //On recupere les permissions selectionnees par l'utilisateur
        $permissions = $data['permissions'];
        //Si permissions existantes
        if(count($permissions)){
            foreach ($permissions as $permission) {
                //On verifie si la permission selectionnee existe en base et on le stocke dans la variable p
                $p = Permission::where('id', '=', $permission)->firstOrFail();
                //On recupere le role qu'on vient de creer
                $role = Role::where('name', '=', $data['nom_role'])->first();
                //On lui donne la permission p
                $role->givePermissionTo($p);

            }
        }
        $successMessage = 'Le nouveau role a été enregistré';
        return redirect('/liste_role')->with('successMessage', $successMessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::where('name', '!=', 'gerer role')->where('name', '!=', 'gerer utilisateur')->get();        
        return view('role.edit')->with(compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $request->validated();
        //On recupere le role a modifier grace a son id
        $role = Role::findOrFail($id);
        $data = $request->all();
        $role->name = $data['nom_role'];
        $role->save();
        $permissions = $data['permissions'];
        $p_all = Permission::all();

        //On enleve toutes les permissions
        foreach ($p_all as $p) {
            $role->revokePermissionTo($p);
        }

        //On recupere chaque permission selectionnée durant la modification et on le donne au role
        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            $role->givePermissionTo($p);
        }

        $successMessage = 'Les modifications ont été enregistrées';
        return redirect('/liste_role')->with('successMessage', $successMessage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        $role = Role::findOrFail($data['id']);
        $role->delete();
        return 'success';
    }
}
