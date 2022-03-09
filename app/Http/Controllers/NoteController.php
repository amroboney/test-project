<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditNoteRequest;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TypeController;

class NoteController extends Controller
{
    //
    public function index()
    {
        $notes = Note::with('type')->get()->map(function($note){
            $note->shareLink = config('app.url'). 'shareNote/'. $note->key ;
            return $note;
        });
        return view('notes.index')->with(['notes' => $notes]);
    }

    // this funciton to open view to add notes
    public function create()
    {
        $types = (new TypeController())->getTypes();
        return view('notes.create')->with(['types' => $types]);
    }

    // this funciton to store notes data
    public function store(StoreNoteRequest $request)
    {
        //Validation
        $validated = $request->validated();
        // update file if exists
        $fileName = (new FileController())->upload($request->file);
        
        $data = $request->only('content', 'type_id');
        $data['file']       = $fileName;
        $data['created_by'] = Auth::user()->id;
        $data['key']        = rand(11111,99999);
        Note::create($data);
        return redirect('/notes')->with('message', 'The Nots Added Successflly!');
    }

    // edit function
    public function edit($id)
    {
        $types = (new TypeController())->getTypes();
        $note  = Note::find($id);
        return view('notes.edit')->with(['types' => $types, 'note' => $note]);
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

        return redirect('/notes')->with('message', 'The Nots updated Successflly!');
    }
    
    // this function to delete notes
    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();
        return true;
    }
    
    // this funciton to share notesindex
    public function shareNote($key)
    {
        $note = Note::with('type', 'user')->where('key', $key)->first();
        $note->file = config('app.url'). 'Files/'. $note->file;
        return view('notes.shareNote')->with([ 'note' => $note]);
    }
}
