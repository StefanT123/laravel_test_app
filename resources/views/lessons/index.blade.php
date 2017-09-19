@extends ('layouts.app')

@section ('content')

<?php
	$first_lesson_id = $lessons->first()->sessions->first()->slug;
	$user_ids = [];
	$session_ids = [];
	$user_sessions = '';
	$i = 0;
?>

	@foreach ( $lessons as $lesson )

    <div class="container">
	    <div class="row">
		    <div class="col-md-8">
		    	<h2>
		    	<a href="lesson/{{ $lesson->slug }}">{{ $lesson->title }}</a>
		    	</h2>

				{{ $lesson->description }}

					<ul>
						@foreach ( $lesson->sessions as $session )

							<?php

								$user_sessions = $session->users->find(Auth::user())['pivot']['session_id'];
								$s_id = (int)$user_sessions + 1;
								$s_slug = $lesson->sessions->find($s_id)['slug'];
								$session_lesson_id = $session->lesson_id;

							?>

							@foreach ( $session->users as $user )
								<?php
									$user_ids[] = $user->pivot->user_id;
									$session_ids[] = $user->pivot->session_id;
								?>
							@endforeach

							@if ( $i == 0 )

								<li><a href="/session/{{ $first_lesson_id }}">{{ $session->title }}</a></li>

							@endif

							@if ( 	in_array(Auth::user()->id, $user_ids)
									&&
									in_array($user_sessions, $session_ids)
									&&
									$session_lesson_id == $lesson->id
									&&
									$lesson->sessions->find($s_id)
								)

								<li><a href="/session/{{ $s_slug }}">{{ $lesson->sessions->find($s_id)['title'] }}</a></li>

							@endif

							<?php

								$i++;

							?>

						@endforeach
					</ul>

				<div class="del">
					@if ( Auth::user()->authorizeRoles(['admin']) )

						<a href="{{ route('lesson.delete', $lesson->id) }}" class="label label-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
						<a href="{{ route('lesson.edit', $lesson->id) }}" class="label label-warning">Edit</a>

					@endif
				</div>
			</div>
		</div>
    </div>

    @endforeach

@endsection