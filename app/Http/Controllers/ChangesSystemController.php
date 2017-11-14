<?php

namespace App\Http\Controllers;

use App\Center;
use App\ChangesSystem;
use App\Document;
use App\Solicitud;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Styde\Html\Facades\Alert;

class ChangesSystemController extends Controller
{
	protected function selectChangesDetailed()
	{
		return Changessystem::selectRaw('number, rs, client, permission, module, detailpermission, other, which,'
    		.'(SELECT users.firstname FROM users WHERE changes_systems.user_id = users.id) as user,'
    		.'(SELECT centers.code FROM centers WHERE changes_systems.center_id = centers.id) as co,'
    		.'(SELECT documents.description FROM documents WHERE changes_systems.document_id = documents.id) as document'
    		);
	}

    public function getLink()
    {
		$center    = Center::pluck('code', 'id')->toArray();
		$document  = Document::pluck('description', 'id')->toArray();
		$solicitud = Solicitud::pluck('description', 'id')->toArray();

		$center    = ['0' => 'Selecciona un C. O.'] + $center;
		$document  = ['Selecc. Documento'] + $document;
		$solicitud = ['Selecciona un Tipo de Solicitud'] + $solicitud;

    	return view('changessystem.index', compact('center', 'document', 'solicitud'));
    }

    public function index()
    {
    	$solicitudes = ChangesSystem::with('user')->get();

    	return view('changessystem.list', compact('solicitudes'));
    }

    public function store(ChangesSystem $changessystem, Request $request)
    {
    	$this->validate($request, [
			'justification' => 'required', 
			'solicitud_id'  => 'integer|required|not_in:0',
    		]);

    	$user = Auth()->user()->id;

    	$changes = new ChangesSystem();
    	$changes->number = $request->get('number');
    	$changes->rs = $request->get('rs');
    	$changes->client = $request->get('client');
    	$changes->permission = $request->get('permission');
    	$changes->module = $request->get('module');
    	$changes->detailpermission = $request->get('detailpermission');
    	$changes->other = $request->get('other');
    	$changes->which = $request->get('which');
    	$changes->justification = $request->get('justification');    	
    	$changes->solicitud_id = $request->get('solicitud_id');
    	$changes->center_id = $request->get('center_id');
    	$changes->document_id = $request->get('document_id');
    	$changes->document_id = $request->get('document_id');
    	$changes->user_id = $user;
    	$changes->save();

    	return redirect()->back();
    }

    public function show($id)
    {
    	$center    = Center::pluck('code', 'id')->toArray();
		$document  = Document::pluck('description', 'id')->toArray();
		$solicitud = Solicitud::pluck('description', 'id')->toArray();

		$center    = ['0' => 'Selecciona un C. O.'] + $center;
		$document  = ['Selecc. Documento'] + $document;
		$solicitud = ['Selecciona un Tipo de Solicitud'] + $solicitud;

    	$change = ChangesSystem::findOrFail($id);

    	return view('changessystem/formChangesSystem', compact('change', 'center', 'document', 'solicitud'));
    }

    public function update(ChangesSystem $changessystem, Request $request)
    {
        if (auth()->user()->id != $request->get('user_id')) {            
            Alert::danger('Esta solicitud fue generada por otro usuario');
            return redirect()->back();
        }


    	$this->validate($request, [
			'justification' => 'required', 
			'solicitud_id'  => 'integer|required|not_in:0',
    		]);

    	
    	$changessystem->number = $request->get('number');
    	$changessystem->rs = $request->get('rs');
    	$changessystem->client = $request->get('client');
    	$changessystem->permission = $request->get('permission');
    	$changessystem->module = $request->get('module');
    	$changessystem->detailpermission = $request->get('detailpermission');
    	$changessystem->other = $request->get('other');
    	$changessystem->which = $request->get('which');
    	$changessystem->justification = $request->get('justification');    	
    	$changessystem->solicitud_id = $request->get('solicitud_id');
    	$changessystem->center_id = $request->get('center_id');
    	$changessystem->document_id = $request->get('document_id');
    	$changessystem->document_id = $request->get('document_id');    	
    	$changessystem->save();

    	return redirect()->back();
    }

    public function getApprove($id)
    {
    	$changes = new ChangesSystem();

    	if ($changes->approved($id)) {
    		return redirect()->back();
    	}

    	return false;
    }

    public function getRunChange($id)
    {
    	$changes = new ChangesSystem();

    	if ($changes->run($id)) {
    		return redirect()->back();
    	}

    	return false;
    }

    public function storeObservation(Request $request, $id)
    {
    	$this->validate($request, [
			'observation' => 'required'
    		]);

    	$changessystem = Changessystem::findOrFail($id);
    	
    	$changessystem->observation = $request->get('observation');
    	
    	$changessystem->update();

    	return redirect()->back();
    	
    }

    public function showObservation($id)
    {
    	$observation = ChangesSystem::find($id);

    	if ($observation->toArray()['observation'] != "") {    		
    		return view('Changessystem/formObservaciones', compact('observation'));
    	} else {
    		return view('Changessystem/formObservaciones', compact('id'));
    	}
    	
    }

    public function getLinkDetailed()
    {
    	$solicitudes = ChangesSystem::with('user')->get();

    	return view('changessystem.listDetailed', compact('solicitudes'));
    }

    public function getListDetailed(Request $request)
    {
    	$solicitudes = $this->selectChangesDetailed()
    	    ->orderBy('id', 'DESC')
    	    ->paginate(1);

    					  	
    	//return response()->json($solicitudes);
    	return [
    		'pagination' => [
				'total'        => $solicitudes->total(),
				'current_page' => $solicitudes->currentPage(),
				'per_page'     => $solicitudes->perPage(),
				'last_page'    => $solicitudes->lastPage(),
				'from'         => $solicitudes->firstItem(),
				'to'           => $solicitudes->lastItem()
    		],
    		'solicitudes' => $solicitudes
    		];
    }

    public function exportExcel()
    {   
        Excel::create('Consulta de Solicitudes', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {                
                $changes = $this->selectChangesDetailed()->get();
                $vista = view('changessystem.exportExcel', compact('changes'));                
                $sheet->loadView('changessystem.exportExcel', compact('changes'));
            });
        })->export('xls');
    }
}
