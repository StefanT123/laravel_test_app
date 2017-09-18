@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $module->title }}</h1>

            {{ $module->description }}

            @foreach ( $module->lessons as $lesson )

                <ul>
                    <li><a href="/lesson/{{ $lesson->slug }}">{{ $lesson->title }}</a></li>
                </ul>

            @endforeach

        </div>
    </div>
</div>
@endsection