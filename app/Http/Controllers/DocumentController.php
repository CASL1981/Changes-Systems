<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function getLink()
	{
		return view('document.index');
	}

    public function index()
    {
    	$document = Document::latest()->paginate(10);
    	
    	return response()->json($document);
    }

    public function store(Document $document, Request $request)
    {
    	
    	$this->validate($request, [
			'description' => 'required|string|max:5|unique:documents',
        ]);
    	
    	$document->create($request->only('description'));
    }

    public function update(Document $document, Request $request)
    {
    	$this->validate($request, [
    		'description' => 'required|string|max:5|unique:documents'
    	]);

    	$document->update(
    		$request->only('description')
    	);
    }

    public function destroy(Document $document)
    {
    	$document->delete();    	
    }
}
