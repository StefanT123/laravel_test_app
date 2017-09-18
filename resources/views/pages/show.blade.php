@extends ('layouts.app')

@section ('content')

<div class="container">
	<div class="row">
		<h1>{{ $page->title }}</h1>

		@if( $page->post_thumbnail )
            <div class="blog-thumbnail">
                <img src="/uploads/{{ $page->post_thumbnail }}" alt="{{ $page->title }}" />
            </div>
        @endif

		{!! $page->content !!}
	</div>
</div>

@endsection