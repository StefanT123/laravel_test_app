
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul>
                <li>{{ $user->id }}</li>
                <li>{{ $user->name }}</li>
                <li>{{ $user->email }}</li>
                <li>{{ $user->roles->first()->name }}</li>

            </ul>
        </div>
    </div>
</div>
@endsection
