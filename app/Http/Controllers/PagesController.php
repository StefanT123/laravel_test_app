<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\User;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreatePageForm;
use Illuminate\Support\Facades\Response;

class PagesController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
    	$pages = Pages::latest()->get();

    	return view('pages.index', compact('pages'));
    }

    public function api()
    {
        // return response()->json(

        //     Pages::where('user_id', Auth::guard('api')->id())->get()

        //     );

        return Pages::all();
    }

    public function image()
    {

        // $path = public_path() . '/uploads/' . $fileName;
        // return Response::download($path);

        $images = [];

        $titles = DB::table('pages')->pluck('post_thumbnail');

        foreach ( $titles as $title ) {

            $images[] = public_path() . '/uploads/' . $title;

        }

        return Response::json(['Links to images' => $images]);

    }

    public function getPage($slug = null)
	{
	    $page = Pages::where('slug', $slug);

	    $page = $page->first();

	    return view('pages.show')->with('page', $page);
	}

	public function createPageView()
	{
		return view('pages.create');
	}

	public function create(CreatePageForm $form)
	{
		$form->storePage();

		session()->flash('message', 'Your page has been successfully created.');

		return redirect('pages');
	}

    public function editPage($id)
    {
        $page = Pages::find($id);

        return view('pages.edit', ['page' => $page]);
    }

    public function update($id, Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $page = Pages::find($id);

        $page->title = $request->input('title');
        $page->content = $request->input('content');
        $page->slug = $request->input('slug');

        if( $request->hasFile('post_thumbnail') ) {
            $post_thumbnail     = $request->file('post_thumbnail');
            $filename           = $request->file('post_thumbnail')->getClientOriginalName();

            Image::make($post_thumbnail)->resize(300, 300)->save( public_path('/uploads/' . $filename ) );

            // Set page-thumbnail url
            $page->post_thumbnail = $filename;
        }

        $page->save();

        session()->flash('message', 'Page has been edited successfully!');

        return redirect('/pages');
    }

	public function deletePage($id)
	{
		Pages::find($id)->delete();

		session()->flash('message', 'Page deleted successfully');

		return view('pages.index');
	}
}
