@extends('backend.admin.layout')

@section('content')
<div class="card mb-4 m-2">

        <div class="card-body">
            <h5 class="card-title">Name: {{ $Data->name }}</h5>
            <p class="card-title">User Email: {{ $Data->email }}</p>
            <hr>
            <a href="{{ route('test.all') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection
