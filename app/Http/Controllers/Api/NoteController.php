<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditNoteRequest;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TypeController;

class NoteController extends Controller
{
    //
    public function index()
    {
        $notes = Note::with('type')->get();
        return response()->json(['responseCode' => 100, 'ResponseMessage' => 'Success', 'data' => $notes]);
    }

    

    // this funciton to store notes data
    public function store(StoreNoteRequest $request)
    {
        //Validation
        $validated = $request->validated();
        // update file if exists
        $fileName = (new FileController())->upload($request->file);
        
        $data = $request->only('content', 'type_id');
        $data['file'] = $fileName;
        Note::create($data);
        return $this->index();
    }


    public function update(EditNoteRequest $request, $id)
    {
        // validation
        $validated = $request->validated();

        // update file if exists
        $fileName = (new FileController())->upload($request->file);

        $note = Note::find($id);
        $data = $request->only('content', 'type_id');
        $data['file'] = $fileName;
        $note->update($data);

        return $this->index();
    }
    
    // this function to delete notes
    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();
        return $this->index();
    }
    
}
