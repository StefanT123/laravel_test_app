@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Module
            </div>
            <div class="panel-body">
                <form enctype="multipart/form-data" action="{{ route('module.update', $module->id) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" class="form-control" value="{{ $module->title }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Description</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="description" class="form-control">{{ $module->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Slug</label>
                        <div class="col-sm-10">
                            <input name="slug" id="slug" class="form-control" value="{{ $module->slug }}">
                        </div>
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