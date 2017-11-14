<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function getLink()
	{
		return view('position.index');
	}

    public function index()
    {
    	$position = Position::orderBy('description', 'DESC')->latest()->paginate(10);
    	
    	return response()->json($position);
    }

    public function store(Position $position, Request $request)
    {
    	
    	$this->validate($request, [
			'description' => 'required|string|max:100|unique:positions',
        ]);
    	
    	$position->create($request->only('description'));
    }

    public function update(Position $position, Request $request)
    {
    	$this->validate($request, [
    		'description' => 'required|string|max:100'
    	]);

    	$position->update(
    		$request->only('description')
    	);
    }

    public function destroy(Position $position)
    {
    	$position->delete();    	
    }
}
