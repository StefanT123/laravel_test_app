<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonsController extends Controller
{
    public function index()
    {
        $lessons = Lesson::orderBy('id', 'asc')->get();

    	return view('lessons.index', compact('lessons'));
    }

    public function allVue()
    {
        return Lesson::all();
    }

	public function create()
	{
		$modules = DB::table('modules')->orderBy('id', 'asc')->get();

		return view('lessons.create_lesson', compact('modules'));
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

    public function store()
    {
        $this->sanitize();

    	$this->validate(request(), [

    		'title' => 'required',
    		'description' => 'required',
    		'module_id' => 'required'

		]);

		Lesson::create(request(['title', 'description', 'module_id', 'slug']));

        session()->flash('message', 'Lesson has been successfully created!');

		return redirect('lessons');
    }

    public function showLesson($slug)
    {
        $lesson_id = DB::table('lessons')->where('slug', $slug)->value('id');

    	$lesson = Lesson::find($lesson_id);

        $last_lesson_id = Lesson::all();

        $lesson_class = new Lesson;

        $first_session = $lesson_class->sessions->first();

    	return view('lessons.single_lesson', compact('lesson', 'last_lesson_id', 'first_session'));
    }

    public function edit($id)
    {
        $modules = DB::table('modules')->orderBy('id', 'asc')->get();
        $lesson = Lesson::find($id);

        return view('lessons.edit', ['lesson' => $lesson, 'modules' => $modules]);
    }

    public function update($id, Request $request)
    {
        $this->sanitize();

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'module_id' => 'required'
        ]);

        $lesson = Lesson::find($id);

        $lesson->title = $request->input('title');
        $lesson->description = $request->input('description');
        $lesson->module_id = $request->input('module_id');
        $lesson->slug = $request->input('slug');

        $lesson->save();

        session()->flash('message', 'Lesson has been edited successfully!');

        return redirect('lessons');
    }

    public function delete($id)
    {
        Lesson::find($id)->delete();

        session()->flash('message', 'Lesson deleted successfully');

        return redirect('lessons');
    }
}
