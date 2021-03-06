@extends ('layouts.app')

@section ('content')

	<div class="container">
		<div class="row">
			<h1>Create Module</h1>

			<hr>

			<form method="POST" action="/module/store">

				{{ csrf_field() }}

				<div class="form-group">
					<label for="title">Title:</label>
					<input type="text" class="form-control" id="title" name="title">
				</div>

				<div class="form-group">
					<label for="body">Description:</label>
					<textarea name="description" id="description" class="form-control"></textarea>
				</div>

				<div class="form-group">
					<label for="slug">Slug</label>
					<input type="text" class="form-control" id="slug" name="slug">
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Publish</button>
				</div>

				@include ('admin.errors')

			</form>

		</div>
	</div>

@endsection