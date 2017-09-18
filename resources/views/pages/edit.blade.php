@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Page
            </div>
            <div class="panel-body">
                <form enctype="multipart/form-data" action="{{ route('page.update', $page->id) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" id="title" class="form-control" value="{{ $page->title }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Content</label>
                        <div class="col-sm-10">
                            <textarea name="content" id="content" class="form-control">{{ $page->content }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" >New Slug</label>
                        <div class="col-sm-10">
                            <input name="slug" id="slug" class="form-control" value="{{ $page->slug }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10">
                            <label for="post_thumbnail">New Thumbnail</label> <br/>
                            <input type="file" name="post_thumbnail" id="post_thumbnail" />
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

<script src="{{ URL::to('src/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>

    var editor_config = {
        path_absolute : "{{ URL::to('/') }}/",
        selector : "textarea#content",
        branding: false,
        height : 450,
        menubar : false,
        preview_styles: 'font-family font-size font-weight font-style text-decoration text-transform color background-color border border-radius outline text-shadow',
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {

            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.grtElementByTagName('body')[0].clientHeight;
            var cmsURL = editor_config.path_absolute+'laravel-filemanaget?field_name'+field_name;

            if (type = 'image') {
                cmsURL = cmsURL+'&type=Images';
            } else {
                cmsUrl = cmsURL+'&type=Files';
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizeble : 'yes',
                close_previous : 'no'
            });
        }
    };

    tinymce.init(editor_config);

</script>﻿

@endsection