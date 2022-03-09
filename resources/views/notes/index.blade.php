@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

            <div class="card">
                <div class="card-header">Notes
                    <a class="add-btn btn btn-primary " href="{{route('notes.create')}}">Add</a>
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Content</th>
                        <th scope="col">Status</th>
                        <th scope="col">File</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notes  as $key  => $note)
                            <tr>
                                <th scope="row"> {{ $key + 1 }}</th>
                                <td>{{ $note->content }}</td>
                                <td>
                                    @if ($note->type->id == 1)
                                        <button type="button" class="btn btn-danger">{{ $note->type->title }}</button>
                                    @elseif($note->type->id ==2)
                                        <button type="button" class="btn btn-warning">{{ $note->type->title }}</button>
                                    @elseif($note->type->id == 3 )
                                        <button type="button" class="btn btn-info">{{ $note->type->title }}</button>
                                    @endif
                                    
                                </td>
                                <td>
                                    @if($note->file)
                                        <a href="/download/{{$note->file}}">Download</a>
                                    @else
                                        Null
                                    @endif
                                </td>
                                <td>{{ $note->created_at }}</td>
                                <td>
                                <a href="{{ route('notes.edit',$note->id) }}" class="btn btn-info btn-block">Edit</a>

                                <a href="#" onclick="deleteNote( {{ $note->id }} )" class="btn btn-danger btn-block">Delete</a>
                                
                                <a href="#" onclick="shareNote(  '{{$note->shareLink}}' )" class="btn btn-warning btn-block"> Share</a>
                               
                                 
                               
                                </td>
                            </tr>
                        @endforeach
                       
                        
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>

<script>
    function deleteNote(id) {
        swal({
            title: 'Do you want to delete note ?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            this.sendFun(id);
        }).catch(swal.noop);
    }


    function sendFun(id){
        var url = "/notes/"+id
        var token = "{{ csrf_token() }}";
        console.log(url);
        $.ajax({
            type: 'DELETE',
            url: url,
            data: {'_token': token},
            container: "#deleteModal",
            success: function (response) {
                location.reload();
            }
        });
    }

    function shareNote( shareLink) {        
        swal(
            'Share Link!',
            shareLink,
            'success'
        )
    }

    
</script>
@endsection
