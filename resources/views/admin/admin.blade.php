
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Area</div>
                <div class="panel-body">
                    Welcome, Admin
                </div>

                @if ( Auth::user()->authorizeRoles(['admin', 'editor']) )
                    <div>
                        <ul>
                            <li><a href="admin/users">See All Users</a></li>
                            <li><a href="admin/user/create">Create New User</a></li>

                            <hr>

                            <li><a href="pages">See All Pages</a></li>
                            <li><a href="admin/page/create">Create New Page</a></li>

                            <hr>

                            <li><a href="modules">See All Modules</a></li>
                            <li><a href="admin/modules/create">Create New Module</a></li>

                            <hr>

                            <li><a href="lessons">See All Lessons</a></li>
                            <li><a href="admin/lessons/create">Create New Lesson</a></li>

                            <hr>

                            <li><a href="sessions">See All Sessions</a></li>
                            <li><a href="admin/sessions/create">Create New Session</a></li>
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection