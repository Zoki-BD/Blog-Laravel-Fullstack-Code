<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
      $posts = Post::paginate(3);

        return view('welcome', compact('posts'));
    }

    public function singlePost(Post $post)//so model dopisano i smenivme namesto id vo
                                         // post i isto si dava kako so findOrFail.
    {
        /*$post = Post::findOrfail($post);*/
        return view('singlePost', compact('post'));
    }

    public function about()
    {
        return view('about');
    }

    //get contact
    public function contact()
    {
        return view('contact');
    }

    //post contact
    public function contactPost()
    {
        return redirect('/');
    }
}
