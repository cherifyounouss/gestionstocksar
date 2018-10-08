<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\UserRequest;
use App\Utilisateur;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilisateurs = Utilisateur::all();
        return view('user.list')->with(compact('utilisateurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.new')->with(compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validated();
        $data = $request->all();
        $utilisateur = new Utilisateur;
        $utilisateur->prenom = $data['prenom'];
        $utilisateur->nom = $data['nom'];
        $utilisateur->email = $data['email'];
        $utilisateur->password = bcrypt($data['password']);
        $utilisateur->save();
        $roles = $data['roles'];
        if (count($roles)) {
            foreach ($roles as $role) {
                //On recupere le role
                $r = Role::where('id', '=', $role)->firstOrFail();
                $utilisateur->assignRole($r);
                $permissions = $r->permissions()->get();
                $utilisateur->givePermissionTo($permissions);
                // print_r(json_encode($permissions));
            }
        }

        $successMessage = 'Un nouvel utilisateur a été enregistré';
        echo "Saved without issues";
        die;
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
        $utilisateur = Utilisateur::findOrFail($id);
        $roles = Role::all();
        return view('user.edit')->with(compact('utilisateur','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $id = $data['id'];
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->delete();
        return "success";
    }
}
