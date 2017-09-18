
@extends('layouts.app')

@section('create_user')

<div class="container">
    <div class="row">
        <h1>Create new user</h1>

        <hr>

        <form method="POST" action="/register">

            {{ csrf_field() }}

            <div class="form-group">
                <label for="name">Name for the user:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email for the user:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password for the user:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Password Confirmation:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="form-group">
                <label for="roles">Select role for the user</label>
                <select name="roles">

                    @foreach ( $roles as $role )

                        @if ( auth()->user()->roles->first()->id <= $role->id)

                            <option value="{{ $role->name }}">{{ $role->name }}</option>

                        @endif

                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Register User</button>
            </div>

            @include('admin.errors')

        </form>

    </div>
</div>

@endsection