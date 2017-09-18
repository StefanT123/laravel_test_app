@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Session
            </div>
            <div class="panel-body">
                <form enctype="multipart/form-data" action="{{ route('session.update', $session->id) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" class="form-control" value="{{ $session->title }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Content</label>
                        <div class="col-sm-10">
                            <textarea name="content" id="content" class="form-control">{{ $session->content }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Slug</label>
                        <div class="col-sm-10">
                            <input name="slug" id="slug" class="form-control" value="{{ $session->slug }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="video">New Video url:</label> <br/>
                        <input type="url" class="form-control" name="video" id="video" value="{{ $session->video }}" />
                    </div>

                    <div class="form-group">
                        <label for="lesson_id">Select parent lesson for this session</label>
                        <select name="lesson_id">

                            @foreach ( $lessons as $lesson )

                                <option value="{{ $lesson->id }}" @if($lesson->id == $session->lesson_id) selected='selected' @endif>{{ $lesson->title }}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-default" value="Edit Page" />
                        </div>
                    </div>

                </form>
            </div>
        </div>

        @include('admin.errors')

    </div>
</div>
@endsection