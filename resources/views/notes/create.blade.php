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
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{route('notes.store')}}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Type *:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="type_id" id="type_id">
                                    <option value=""> Select Type</option>
                                    @foreach ($types as $type )
                                        <option @if (old('type_id') == $type->id) {{ 'selected' }} @endif  value="{{$type->id}}" > {{ $type->title }} </option>
                                    @endforeach
                                </select>     
                                @error('type_id')
                                    <span class="invalid-input" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                       
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Upload File:</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" value="{{old('file')}}" id="file" name="file" > 
                                @error('file')
                                    <span class="invalid-input" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                          
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Content *:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="content" name="content" rows="3" > {{old('content')}} </textarea>    
                                @error('content')
                                    <span class="invalid-input" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                   
                            </div>
                        </div>

                        <br>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        </form>

                        <br>
                    </div>
                </div>
            </div>
      </div>
</div>

@endsection