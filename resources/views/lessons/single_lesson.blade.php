@extends('layouts.app')

<?php
    $user_ids = [];
    $session_ids = [];
    $user_sessions = '';
    $current_lesson_id = $lesson->sessions->first()->id;
    $user_sessions_id = '';
    $lesson_id = $lesson->id;
    $next_lesson_id = (int)$lesson_id + 1;
    $i = 0;
    $last_session_id = 0;
?>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $lesson->title }}</h1>

            {{ $lesson->description }}

            <ul>

                @foreach ( $lesson->sessions as $session )

                <?php

                    $last_session_id = $session->id;
                    $user_sessions_id = $session->users->find(Auth::user())['pivot']['session_id'];

                ?>

                    @foreach ( $session->users as $user )

                        <?php

                            $user_ids[] = $user->pivot->user_id;
                            $session_ids[] = $user->pivot->session_id;
                            $current_lesson_id = $user->find(Auth::user()->id)->sessions->last()->id;

                        ?>

                    @endforeach

                    <?php

                        $first_session_slug = $session->find($current_lesson_id)['slug'];

                    ?>

                    @if ( in_array(Auth::user()->id, $user_ids) && in_array($user_sessions_id, $session_ids) )

                        <li class="sessions"><a href="/session/{{ $session->slug }}">{{ $session->title }}</a></li>

                    @elseif ( empty($session_ids) && $i == 0 )

                        <li class="sessions"><a href="/session/{{ $first_session_slug }}">{{ $session->title }}</a></li>

                    @endif

                    <?php $i++; ?>

                @endforeach

                @if ( $current_lesson_id < $lesson->sessions->last()->id && in_array($current_lesson_id, $session_ids) )

                    <?php
                        $next_id = (int)$current_lesson_id + 1;
                        $next_slug = $lesson->sessions->find($next_id)['slug'];
                    ?>

                    <li><a href="/session/{{ $next_slug }}" class="next_session">{{$lesson->sessions->find($next_id)->title}}</a></li>

                @elseif ( $next_lesson_id <= $last_lesson_id->last()->id && $current_lesson_id == $last_session_id && in_array($current_lesson_id, $session_ids) )

                    <a href="/lesson/{{ $next_lesson_id }}">Go to the next lesson</a>

                @endif

            </ul>

        </div>
    </div>
</div>
@endsection