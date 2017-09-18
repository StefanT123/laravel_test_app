<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegistrationForm;

class UsersController extends Controller
{
    public function showAllUsers()
    {
    	$users = User::all();

    	return view('admin.all_users', compact('users'));
    }

    public function adminView(Request $request)
    {

        $permission = $request->user()->authorizeRoles(['admin', 'editor']);

        if ( $permission )
        {

    	   return view('admin.admin');

        } else {

            session()->flash('error_message', 'You dont have permission to view this page');

            return redirect('/home');

        }
    }

    public function createUserView()
    {
        $roles = DB::table('roles')->orderBy('id', 'desc')->get();

        return view('admin.create_user', compact('roles'));
    }

    public function showUser($id)
    {
    	$user = User::find($id);

    	return view('admin.user', compact('user'));
    }

    public function createUser(RegistrationForm $form)
    {
    	$form->persist();

    	session()->flash('message', 'New user have been created');

    	return redirect('/home');
    }

    public function deleteUser($id)
    {
    	User::find($id)->delete();

    	session()->flash('message', 'User have been deleted');

    	return redirect('/admin/users');
    }

    public function editUser($id)
    {
        $user = User::find($id);

        return view('admin.edit_user', ['user' => $user]);
    }

    public function update($id, Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        $userData = $request->all();

        User::find($id)->update($userData);

        session()->flash('message', 'User has been edited successfully!');

        return redirect('/users');
    }
}
