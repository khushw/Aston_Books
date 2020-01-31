<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Gate;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //calls the auth middlewear function to check whetehr it is a logged in user, if not it wil redirect to login page
    public function __construct(){
        $this->middleware('auth');
    }
        
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index()
    {
        //find and return all the users in the admin index page
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //it checks the gate in AuthServiceProvider.php and if user isnt admin they will be redirected to admin.users.index page
        if(Gate::denies('edit-users')){
            return redirect(route('admin.users.index'));
        }
        $roles = Role::all();

        return view('admin.users.edit')->with   ([
                                            'user' => $user,
                                            'roles' => $roles
                                                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //due to array of roles we use sync 
        //sync all roles user has selected and assign to user roles
        $user->roles()->sync($request->roles);
        
        //when the user edits the form it will take their input and add it here 
        $user->name = $request->name;
        $user->email = $request->email;
        
        //flash messages if the user has been saved then display success else error message
        if($user->save()){
            $request->session()->flash('success', $user->name. ' has been updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the user');
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }
        
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
