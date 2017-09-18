
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="show-all-users">
                <h2>Users:</h2>
                    <ul>
                        @foreach ( $users as $user )

                            <li>
                                <a href="users/{{ $user->id }}">{{ $user->name }}</a>

                                @if ( Auth::user()->authorizeRoles(['admin']) || Auth::user()->id == $user->id )
                                    @if ( Auth::user()->id != $user->id )
                                        <a href="{{ route('user.delete', $user->id) }}" class="label label-danger">Delete</a>
                                    @endif
                                    <a href="{{ route('user.edit', $user->id) }}" class="label label-warning">Edit</a>
                                @endif

                            </li>

                        @endforeach
                    </ul>

                    @if ( Auth::user()->authorizeRoles(['admin', 'editor']) )
                        <p><a href="user/create">Create new user</a></p>
                    @endif

                </div>

            </div>
        </div>
    </div>
</div>
@endsection