<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use Auth;

class AdministrateUsersController extends Controller
{
	function listUsers(){
		
		$users = User::paginate(50);
		return view('auth.list-users')->with('users',$users);
	}
	public function assignRole($userid,$rolename){
		if( $rolename == "superadministrator" && !Auth::user()->hasRole('superadministrator'))
			return response(403);

		$user = User::whereId($userid)->first();
		if( !$user->hasRole($rolename))
			$user->attachRole($rolename);
		$user->save();
		return redirect('list-users');
	}
	public function removeRole($userid,$rolename){
		if( $rolename == "superadministrator" && !Auth::user()->hasRole('superadministrator'))
			return response(403);
		$user = User::whereId($userid)->first();
		if( $user->hasRole($rolename))
			$user->detachRole($rolename);
		$user->save();
		return redirect('list-users');
	}
}
