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
                <div class="card-header">Report
                </div>
                
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Urgent</th>
                        <th scope="col">Normal</th>
                        <th scope="col">On Date </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users  as $key  => $user)
                            <tr>
                                <th scope="row"> {{ $key + 1 }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->urgent_count }}</td>
                                <td>{{ $user->normal_count }}</td>
                                <td>{{ $user->on_date_count }}</td>
                                
                            </tr>
                        @endforeach
                       
                        
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>
@endsection
