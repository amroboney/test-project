@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Add Note
                </div>
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{route('notes.update', $note->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Type *:</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" disabled value="{{$note->type->title}}">                      
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Upload File:</label>
                            <div class="col-sm-10">
                                <img src="{{$note->file}}" with="400" height="400">                        
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Content *:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="content" name="content" disabled rows="3"> {{ $note->content }} </textarea>    
                                                
                            </div>
                        </div>

                        <br>
                        
                        </form>

                        <br>
                    </div>
                </div>
            </div>
      </div>
</div>

@endsection