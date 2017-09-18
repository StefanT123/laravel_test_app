@extends ('layouts.app')

@section ('content')


<div class="container">
<div class="row">
	@forelse ( $sessions as $session )

	    <div class="col-md-8">
	    	<h2>
	    	<a href="{{ route('session.single', $session->slug) }}">{{ $session->title }}</a>
	    	</h2>

			{{ $session->content }}

			<div>
				<embed src="{{ $session->video }}" width="300" height="300">
			</div>

			<div class="del">
				@if ( Auth::user()->authorizeRoles(['admin']) )

					<a href="{{ route('session.delete', $session->id) }}" class="label label-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
					<a href="{{ route('session.edit', $session->id) }}" class="label label-warning">Edit</a>

				@endif
			</div>
		</div>

    @empty

    	 <div class="col-md-8">
	    	<h2>
	    	<a href="{{ route('session.single', $first_session->slug) }}">{{ $first_session->title }}</a>
	    	</h2>

			{{ $first_session->content }}

			<div>
				<embed src="{{ $first_session->video }}" width="300" height="300">
			</div>

			<div class="del">
				@if ( Auth::user()->authorizeRoles(['admin']) )

					<a href="{{ route('session.delete', $first_session->id) }}" class="label label-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
					<a href="{{ route('session.edit', $first_session->id) }}" class="label label-warning">Edit</a>

				@endif
			</div>
		</div>

    @endforelse

</div>
</div>

@endsection