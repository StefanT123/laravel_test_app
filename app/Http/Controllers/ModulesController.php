<?php

namespace App\Http\Controllers;

use App\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModulesController extends Controller
{
	public function index()
	{
		$modules = Module::orderBy('id', 'asc')->get();

		return view('modules.index', compact('modules'));
	}

    public function allVue()
    {
        return Module::all();
    }

	public function create()
	{
		return view('modules.create_module');
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
    		'description' => 'required'

		]);

		Module::create(request(['title', 'description', 'slug']));

		session()->flash('message', 'Module has been successfully created!');

		return redirect('modules');
    }

    public function showModule($slug)
    {
        $module_id = DB::table('modules')->where('slug', $slug)->value('id');
    	$module = Module::find($module_id);

    	return view('modules.single_module', compact('module'));
    }

    public function edit($id)
    {
        $module = Module::find($id);

        return view('modules.edit', ['module' => $module]);
    }

    public function update($id, Request $request)
    {
        $this->sanitize();

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $module = Module::find($id);

        $module->title = $request->input('title');
        $module->description = $request->input('description');
        $module->slug = $request->input('slug');

        $module->save();

        session()->flash('message', 'Module has been edited successfully!');

        return redirect('modules');
    }

    public function delete($id)
    {
        Module::find($id)->delete();

        session()->flash('message', 'Module deleted successfully');

        return redirect('modules');
    }
}
