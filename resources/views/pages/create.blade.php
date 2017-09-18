@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<h1>Create Page</h1>

			<hr>

			<form enctype="multipart/form-data" method="POST" action="/page/store">

			{{ csrf_field() }}

			  <div class="form-group">
			    <label for="title">Title:</label>
			    <input type="text" class="form-control" id="title" name="title">
			  </div>

			  <div class="form-group">
			    <label for="body">Content</label>
			    <textarea name="content" id="content" class="form-control"></textarea>
			    <input name="image" type="file" id="upload" class="hidden" onchange="">
			  </div>

			  <div class="form-group">
			    <label for="slug">Slug</label>
			    <input type="text" class="form-control" id="slug" name="slug">
			  </div>

			  <div class="form-group">
					<label for="post_thumbnail">Thumbnail</label> <br/>
					<input type="file" name="post_thumbnail" id="post_thumbnail" />
				</div>

			<div class="form-group">
			  <button type="submit" class="btn btn-primary">Publish</button>
		  	</div>

			@include ('admin.errors')

			</form>

		</div>
	</div>

	<script src="{{ URL::to('src/tinymce/js/tinymce/tinymce.min.js') }}"></script>
	<script>

		var editor_config = {
			path_absolute : "{{ asset("uploads") }}",
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
		    file_picker_callback: function(callback, value, meta) {

		      if (meta.filetype == 'image') {

		        $('#upload').trigger('click');

		        $('#upload').on('change', function() {

		          var file = this.files[0];
		          var reader = new FileReader();

		          reader.onload = function(e) {

		            callback(e.target.result, {
		              alt: ''
		            });

		          };

		          reader.readAsDataURL(file);

		        });

		      }

		    },
		};

		tinymce.init(editor_config);

  	</script>﻿

@endsection