<?php

namespace App\Http\Requests;

use Auth;
use Image;
use App\User;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CreatePageForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->sanitize();

        return [

            'title' => 'required',
            'content' => 'required',
            // 'slug' => 'required'

        ];
    }

    public function sanitize()
    {
        $input = parent::all();
        $slug = '';

        if ($input['slug'] != '')
        {

            $input['slug'] = strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', $input['slug']));

        }

        return $input;
    }

    public function storePage()
    {
        $page = new Pages;

        $page->title = request('title');
        $page->content = request('content');
        $page->slug = request('slug') ? request('slug') : strtolower(preg_replace('/[^a-zA-Z0-9]/', '-', request('title')));
        $page->user_id = Auth::user()->id;

        if( request()->hasFile('post_thumbnail') )
        {
            $post_thumbnail     = request()->file('post_thumbnail');
            $filename           = request()->file('post_thumbnail')->getClientOriginalName();;

            Image::make($post_thumbnail)->resize(300, 300)->save( public_path('uploads/' . $filename ) );

            $page->post_thumbnail = $filename;
        }

        $page->save();
    }
}
