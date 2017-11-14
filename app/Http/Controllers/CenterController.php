<?php

namespace App\Http\Controllers;

use App\center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Styde\Html\Facades\Alert;

class CenterController extends Controller
{
	public function getLink()
	{
		return view('center.index');
	}

    public function index()
    {
    	$centers = Center::orderBy('code', 'desc')->latest()->paginate(10);
    	
    	return response()->json($centers);

    }

    public function store(Center $center, Request $request)
    {
    	
    	$this->validate($request, [
			'code'        => 'required|string|max:3|unique:centers',
			'description' => 'required|string|max:100',
        ]);
    	
    	$center->create($request->only('code', 'description'));

    }

    public function update(Center $center, Request $request)
    {
    	$this->validate($request, [
    		'description' => 'required|string|max:100'
    	]);

    	$center->update(
    		$request->only('description')
    	);
    }

    public function destroy(Center $center)
    {
    	$center->delete();
    	
    }
}
