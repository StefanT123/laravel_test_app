@extends ('layouts.app')

<?php

	$lesson_id = [];

?>

@section ('content')

	@foreach ( $modules as $module )

	    <div class="container">
		    <div class="row">
			    <div class="col-md-8">
			    	<h2>
			    	<a href="module/{{ $module->slug }}">{{ $module->title }}</a>
			    	</h2>

					{{ $module->description }}

					<ul>
						@foreach ( $module->lessons as $lesson )

							@foreach ( $lesson->sessions->where('lesson_id', $lesson->id) as $session )

								<?php

									$sessions_in_lesson[] = $session->id;

								?>

								@foreach ( $session->users as $user )

									<?php

										$lesson_id = $lesson->sessions->find($user->pivot->session_id)->lesson_id;

									?>

								@endforeach

							@endforeach

							<li><a href="/lesson/{{$lesson->slug}}">{{ $lesson->title }}</a></li>

						@endforeach
					</ul>

					<div class="del">
						@if ( Auth::user()->authorizeRoles(['admin']) )

							<a href="{{ route('module.delete', $module->id) }}" class="label label-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
							<a href="{{ route('module.edit', $module->id) }}" class="label label-warning">Edit</a>

						@endif
					</div>
				</div>
			</div>
	    </div>

    @endforeach

@endsection