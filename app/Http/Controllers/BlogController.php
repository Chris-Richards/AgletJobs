<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Blog;
use App\Tag;

class BlogController extends Controller
{
    
    public function create(Request $request)
    {
        $tags = Tag::get();

        $blog = new Blog();
        $blog->user_id = Auth::id();
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');

        $blogTags = [];

        foreach ($request->post() as $k => $r) {
            if ($k == "location") { continue; }
            foreach ($tags as $tag) {
                if ($r == $tag->id) {
                    array_push($blogTags, $r);
                }
            }
        }

        $blog->tags = $blogTags;
        $blog->save();

        return redirect('/blog/' . $blog->id);
    }

    public function view($id)
    {
        $blog = Blog::where('id', $id)->first();

        return view('blogs.view', [
            'blog' => $blog,
            'title' => $blog->title . ' - Aglet'
        ]);
    }

}
