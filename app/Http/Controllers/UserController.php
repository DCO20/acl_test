<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('Ver Usuário')){
            throw new UnauthorizedException('403', 'You do not the required author authorization');
        }

       $users = User::all();

       return view('users.index',
       [ 'users' => $users]
    );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('Adicionar Usuário')){
            throw new UnauthorizedException('403', 'You do not the required author authorization');
        }
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('users.index')->with('message', 'Usuário criado com sucesso!.');
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
        if(!Auth::user()->hasPermissionTo('Editar Usuário')){
            throw new UnauthorizedException('403', 'You do not the required author authorization');
        }

        $user = User::where('id', $id)->first();

        return view('users.edit', ['user' => $user]);
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

        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;

        if(!empty($request->password)){
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('message', 'Usuaŕio atualizado com sucesso!.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('Excluir Usuário')){
            throw new UnauthorizedException('403', 'You do not the required author authorization');
        }

        $user = User::where('id', $id)->first();
        $user->delete();

        return back()->with('message_danger', 'Usuário excluído com sucesso!.');
    
    }

    public function roles($user)
    {
        if(!Auth::user()->hasPermissionTo('Ver Perfis')){
            throw new UnauthorizedException('403', 'You do not the required author authorization');
        }

        $user = User::where('id', $user)->first();
        $roles = Role::all();

        foreach ($roles as $role) {
            if($user->hasRole($role->name)){
                $role->can = true;
            } else {
                $role->can = false;
            }
        }

        return view('users.roles',[
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function rolesSync(Request $request, $user)
    {
        $rolesRequest = $request->except(['_token', '_method']);

        foreach($rolesRequest as $key => $value){
            $roles[] = Role::where('id', $key)->first();
        }

        $user = User::where('id', $user)->first();
        if(!empty($roles)){
            $user->syncRoles($roles);
        } else {
            $user->syncRoles(null);
        }

        return redirect()->route('user.roles', ['user' => $user->id]);
    }
}