@extends('layouts.app')

@section('content')

  @foreach ($pages as $page)

    <div class="container">
	    <div class="row">
		    <div class="col-md-8">
		    	<h2>
		    	<a href="/pages/{{ $page->slug }}">{{ $page->title }}</a>
		    	</h2>

		    	<div class="blog-thumbnail">
					<img src="/uploads/{{ $page->post_thumbnail }}" alt="{{ $page->title }}" />
				</div>

				{!! $page->content !!}

				<div class="del">
					@if ( Auth::user()->authorizeRoles(['admin', 'editor']) )

						<a href="{{ route('page.delete', $page->id) }}" class="label label-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>

					@endif

					@if ( Auth::user()->authorizeRoles(['admin', 'editor']) || Auth::user()->id === $page->user_id )

						<a href="{{ route('page.edit', $page->id) }}" class="label label-warning">Edit</a>

					@endif
				</div>
			</div>
		</div>
    </div>

  @endforeach

@endsection