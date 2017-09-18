@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Lesson
            </div>
            <div class="panel-body">
                <form enctype="multipart/form-data" action="{{ route('lesson.update', $lesson->id) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" class="form-control" value="{{ $lesson->title }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="description" class="form-control">{{ $lesson->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Slug</label>
                        <div class="col-sm-10">
                            <input name="slug" id="slug" class="form-control" value="{{ $lesson->slug }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="module_id">Select parent module for this lesson</label>
                        <select name="module_id">

                            @foreach ( $modules as $module )

                                <option value="{{ $module->id }}" @if($module->id == $lesson->module_id) selected='selected' @endif>{{ $module->title }}</option>

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