<?php

namespace App\Http\Controllers;

use Auth;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionsController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $user_role = Auth::user()->authorizeRoles(['admin', 'editor']);
        $s = '';
        $first_session = '';

        if ( !$user_role )
        {

            $s = Session::whereHas('users', function($q) use ($user_id) {
                $q->where('user_id', '=', $user_id);
            })->get(); // get completed sessions

            $first_session = Session::all()->first();

            $sessions = Auth::user()->sessions; // better way to get completed sessions

        } else {

            $sessions = Session::orderBy('lesson_id', 'asc')->get();

        }

    	return view('sessions.index', compact('sessions', 'first_session'));
    }

    public function api()
    {
        return Session::all();
    }

	public function create()
	{
		$lessons = DB::table('lessons')->orderBy('id', 'asc')->get();

		return view('sessions.create_session', compact('lessons'));
	}

    public function sanitize()
    {
        $input = request();

        if ($input['slug'] != '')
        {

            $input['slug'] = strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', $input['slug']));

        } else {

            $input['slug'] = strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', $input['title']));

        }

        return $input;
    }

    public function store(Request $request)
    {
        $this->sanitize();

    	$this->validate(request(), [

    		'title' => 'required',
    		'content' => 'required',
    		'lesson_id' => 'required'

		]);

        $session = new Session;

        $session->title = $request->input('title');
        $session->content = $request->input('content');
        $session->lesson_id = $request->input('lesson_id');
        $session->video = $request->input('video');
        $session->slug = $request->input('slug');

        // if( $request->hasFile('video') ) {

        //     $video     	= $request->file('video');
        //     $filename	= $request->file('video')->getClientOriginalName();
        //     $path 		= public_path() . '/uploads/';

        //     $session->video = $filename;

        //     $video->move($path, $filename);
        // }

        $session->save();

        session()->flash('message', 'Session has been created successfully!');

		return redirect('sessions');
    }

    public function edit($id)
    {
        $lessons = DB::table('lessons')->orderBy('id', 'asc')->get();
        $session = Session::find($id);

        return view('sessions.edit', ['session' => $session, 'lessons' => $lessons]);
    }

    public function update($id, Request $request)
    {
        $this->sanitize();

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'lesson_id' => 'required'
        ]);

        $session = Session::find($id);

        $session->title = $request->input('title');
        $session->content = $request->input('content');
        $session->lesson_id = $request->input('lesson_id');
        $session->video = $request->input('video');
        $session->slug = $request->input('slug');

        $session->save();

        session()->flash('message', 'Session has been edited successfully!');

        return redirect('sessions');
    }

    public function delete($id)
    {
        Session::find($id)->delete();

        session()->flash('message', 'Session deleted successfully');

        return redirect('sessions');
    }

    public function showSession($slug)
    {
        $session_id = DB::table('sessions')->where('slug', $slug)->value('id');
        $session = Session::find($session_id);

        $next_id = $session_id + 1;
        $prev_id = $session_id - 1;

        if ( $next_id )
        {
            $next = Session::find($next_id);

        } else {

            $next = '';

        }

        if ( $prev_id )
        {
            $prev = Session::find($prev_id);

        } else {

            $prev = '';

        }

        return view('sessions.single_session', compact('session', 'next', 'prev'));
    }

    public function completed(Request $request)
    {
        $id = $request->input('id');
        $user_id = $request->input('user_id');

        $session = Session::find($id);
        $next_session_id = (int)$id + 1;
        $next_session = Session::find($next_session_id);
        $next_session_slug = $next_session->slug;

        $lesson_id = $session->lesson_id;

        $next_lesson = $lesson_id ? (int)$lesson_id + 1 : '';

        $session->users()->attach($user_id);

        return ['id' => $next_lesson, 'slug' => $next_session_slug];
    }
}
