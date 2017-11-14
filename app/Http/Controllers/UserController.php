<?php

namespace App\Http\Controllers;

use App\Center;
use App\Position;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * return to the users index view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLink()
    {
    	$center = Center::pluck('description', 'id')->toArray();
    	$position = Position::pluck('description', 'id')->toArray();

    	$center = ['0' => 'Selecciona un C. O.'] + $center;
    	$position = ['Selecciona un Cargo'] + $position;

    	return view('users.index', compact('center', 'position'));
    }

    public function index()
    {
    	$users = User::with('position', 'center')->get();

    	return view('users.list', compact('users'));
    }

    public function edit($id)
    {
    	$user = User::findOrFail($id);
    	$center = Center::pluck('description', 'id')->toArray();
    	$position = Position::pluck('description', 'id')->toArray();

    	return view('users.edit', compact('user', 'center', 'position'));
    }

    public function store(User $user, Request $request)
    {
    	$this->validate($request, [
			'firstname' => 'required|string|max:190',
			'lastname'  => 'required|string|max:190',
			'email'     => 'required|email|unique:users',
			'password'  => 'required|min:6',
			'area'      => 'required|in:administracion,comercial,farmacia',
			'role'      => 'required|in:admin,edit,normal'
        ]);
    	
    	$user->create([
			'firstname'   => $request->get('firstname'),
			'lastname'    => $request->get('lastname'),
			'email'       => $request->get('email'),
			'password'    => bcrypt($request->get('password')),
			'area'        => $request->get('area'),
			'role'        => $request->get('role'),
			'position_id' => $request->get('position_id'),
			'center_id'   => $request->get('center_id')
    	]);

    	return Redirect()->back();
    }

    public function update(User $user, Request $request)
    {

    	$this->validate($request, [
			'firstname' => 'required|string|max:190',
			'lastname'  => 'required|string|max:190',
			'email'     => 'required|email',			
			'area'      => 'required|in:administracion,comercial,farmacia',
			'role'      => 'required|in:admin,edit,normal'
        ]);

    	$user->firstname = $request->firstname;
    	$user->lastname = $request->lastname;
    	$user->email = $request->email;
    	$user->area = $request->area;
    	$user->role = $request->role;
    	$user->center_id = $request->center;
    	$user->position_id = $request->position;
    	
    	$user->save();

    	$users = User::with('position', 'center')->get();

    	return view('users.list', compact('users'));
    }

    public function destroy(User $user)
    {
    	$user->delete();    	
    }
}
