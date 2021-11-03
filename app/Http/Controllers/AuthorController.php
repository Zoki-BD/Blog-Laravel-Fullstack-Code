<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Http\Requests\CreatePost;
use App\Post;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{


   public function  __construct()
   {
      $this->middleware('checkRole:author');
      $this->middleware('auth');
   }

   public function dashboard()
   {

      $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();


      $allComments = Comment::whereIn('post_id', $posts)->get();


      $todayComments =  $allComments->where('created_at', '>=', Carbon::today())->count();



      //kreirame instance na klasata DashboardChart
      $chart = new DashboardChart();

      $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());

      $posts = [];

      foreach ($days as $day) {
         $posts[] = Post::whereDate('created_at', $day)->where('user_id', Auth::id())->count();
      }


      $chart->dataset('Posts', 'line', $posts);

      $chart->labels($days);

      return view('author.dashboard', compact('allComments', 'todayComments', 'chart'));
   }


   //mora da kreirame function za odreduvanje na kolkav vreme.period da crpi chartot
   private function generateDateRange(Carbon $start_date, Carbon $end_date)
   {
      $dates = [];

      for ($date = $start_date; $date->lte($end_date); $date->addDay()) {
         $dates[] = $date->format('Y-m-d');
      }

      return $dates;
   }


   public function posts()
   {
      return view('author.posts');
   }

   public function comments()
   {
      $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();

      $comments = Comment::whereIn('post_id', $posts)->get();

      return view('author.comments', compact('comments'));
   }


   //get new post page
   public function newPost()
   {
      return view('author.newPost');
   }

   //post new post 
   public function createPost(CreatePost $request)
   {
      $post = new Post();
      $post->user_id = Auth::id();
      $post->title = $request['title'];
      $post->content = $request['content'];
      $post->save();


      return back()->with('success', 'Post is successfully created.');
   }

   //get edit post
   public function postEdit($id)
   {
      $post = Post::where('id', $id)->where('user_id', Auth::id())->first();

      return view('author.editPost', compact('post'));
   }

   //post edit post
   public function postEditPost(CreatePost $request, $id)
   {
      //go barame toj post
      $post = Post::where('id', $id)->where('user_id', Auth::id())->first();

      //prenesuvame values
      $post->title = $request['title'];
      $post->content = $request['content'];
      $post->save();

      return back()->with('success', "Post updated successfully");
   }


   //post deleting
   public function deletePost($id)
   {
      $post = Post::where('id', $id)->where('user_id', Auth::id())->first();

      if (!$post) {
         return back()->with('error', "Post does not exist");
      }

      $post->delete();

      return back()->with('success', "Post deleted successfully");
   }
}
