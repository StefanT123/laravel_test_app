@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<h1>Create Page</h1>

			<hr>

			<form enctype="multipart/form-data" method="POST" action="/session/store">

			{{ csrf_field() }}

				<div class="form-group">
					<label for="title">Title:</label>
					<input type="text" class="form-control" id="title" name="title">
				</div>

				<div class="form-group">
					<label for="body">Content:</label>
					<textarea name="content" id="content" class="form-control"></textarea>
				</div>

				<div class="form-group">
					<label for="slug">Slug</label>
					<input type="text" class="form-control" id="slug" name="slug">
				</div>

				<div class="form-group">
					<label for="video">Video url:</label> <br/>
					<input type="url" class="form-control" name="video" id="video" />
				</div>

				<div class="form-group">
	                <label for="lesson_id">Select parent lesson for this session</label>
	                <select name="lesson_id">

	                    @foreach ( $lessons as $lesson )

                            <option value="{{ $lesson->id }}" @if(old('lesson') && old('lesson') == $lesson->id) selected='selected' @endif>{{ $lesson->title }}</option>

	                    @endforeach

	                </select>
	            </div>

				<div class="form-group">
				<button type="submit" class="btn btn-primary">Publish</button>
				</div>

			@include ('admin.errors')

			</form>

		</div>
	</div>

@endsection