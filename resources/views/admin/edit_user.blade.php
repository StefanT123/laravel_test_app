@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit User
            </div>
            <div class="panel-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Email</label>
                        <div class="col-sm-10">
                            <input name="email" id="email" class="form-control" value="{{ $user->email }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Password</label>
                        <div class="col-sm-10">
                            <input name="password" id="password" class="form-control" value="{{ $user->password }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >Password Confirmation</label>
                        <div class="col-sm-10">
                            <input name="password_confirmation" id="password_confirmation" class="form-control" value="{{ $user->password }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-default" value="Edit User" />
                        </div>
                    </div>

                </form>
            </div>
        </div>

        @include('admin.errors')

    </div>
</div>
@endsection