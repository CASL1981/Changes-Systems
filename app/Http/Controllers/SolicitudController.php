<?php

namespace App\Http\Controllers;

use App\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function getLink()
	{
		return view('solicitud.index');
	}

    public function index()
    {
    	$solicitud = Solicitud::orderBy('description', 'DESC')->latest()->paginate(10);
    	
    	return response()->json($solicitud);
    }

    public function store(Solicitud $solicitud, Request $request)
    {
    	
    	$this->validate($request, [
			'description' => 'required|string|max:190|unique:solicitudes',
        ]);
    	
    	$solicitud->create($request->only('description'));
    }

    public function update(Solicitud $solicitud, Request $request)
    {
    	$this->validate($request, [
    		'description' => 'required|string|max:190|unique:solicitudes'
    	]);

    	$solicitud->update(
    		$request->only('description')
    	);
    }

    public function destroy(Solicitud $solicitud)
    {
    	$solicitud->delete();    	
    }
}
