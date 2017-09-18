@extends('layouts.app')

<?php

    $users = new App\User;
    $user = $users->find(Auth::user()->id);
    $user_id = $user->id;
    $completed_sessions = array();
    $completed_session_id = (int)$session->id - 1;

    $sessions = $user->sessions;

?>

<hr>

@foreach ( $sessions as $session_pivot )
   <?php $completed_sessions[] = $session_pivot->pivot->session_id; ?>
@endforeach

@section('content')

@if ( in_array($completed_session_id, $completed_sessions) || $session->id == 1 )

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $session->title }}</h1>
        </div>

        <div class="col-md-8 col-md-offset-2">
            {{ $session->content }}
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div>
                <embed src="{{ $session->video }}" width="300" height="300">
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <form action="/session/completed" method="POST">

                <?php
                    $checked = !in_array(((int)$completed_session_id + 1), $completed_sessions) ? '' : 'checked disabled';
                    $lesson_id = !empty((int)$session->lesson->id + 1) ? $session->lesson->id : '';
                    //$session = ((int)$session->id + 1);
                ?>

                <input type="checkbox" data-id="{{ $session->id }}" data-user="{{ $user_id }}" data-lesson="{{ $lesson_id }}" name="completed" id="completed" {{ $checked }}>

            </form>
        </div>

        <div class="col-md-8 col-md-offset-2 navigation">

            @if ( is_object($prev) )
                <a href="{{ $prev->slug }}" id="prev_session">Previous</a>
            @endif

            @if ( is_object($next) )
                <a href="{{ $next->slug }}" id="next_session">Next</a>
            @endif

        </div>

        @elseif ( !in_array($completed_session_id, $completed_sessions) )

            <h1>No cheating</h1>

            <div class="col-md-8 col-md-offset-2 navigation">
                @if ( is_object($prev) )
                    <a href="{{ $prev->slug }}" id="prev_session">Previous</a>
                @endif
            </div>

        @endif

        </div>
    </div>
</div>


@endsection
