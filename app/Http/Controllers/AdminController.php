<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Comment;
use App\Http\Requests\CreatePost;
use App\Http\Requests\UserUpdate;
use App\Post;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

   public function __construct()
   {
      $this->middleware('checkRole:admin');
      $this->middleware('auth');
   }

   public function dashboard()
   {
      //kreirame instance na klasata DChart
      $chart = new DashboardChart();

      $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());

      $posts = [];

      foreach ($days as $day) {            //ovde nema auth:: posto sakame za site da gi dobieme postovite
         $posts[] = Comment::whereDate('created_at', $day)->count();
      }


      $chart->dataset("Everyone's Posts", 'line', $posts);

      $chart->labels($days);


      return view('admin.dashboard', compact('chart'));
   }


   //kreirame function za odreduvanje na kolkav vreme.period da crpi chartot
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
      $posts = Post::all();
      return view('admin.posts', compact('posts'));
   }

   public function comments()
   {
      $comments = Comment::all();
      return view('admin.comments', compact('comments'));
   }

   public function deleteComment($id)
   {
      $comment = Comment::where('id', $id)->delete();

      if (!$comment) {
         return back()->with('error', "That comment no longer exist.");
      }

      return back()->with('success', "Selected comment was successfully removed.");
   }

   public function users()
   {
      $users = User::all();
      return view('admin.users', compact('users'));
   }
   //_________________________________________________________________________________________________________________________




   //get edit admin post
   public function postEdit($id)
   {
      $post = Post::where('id', $id)->first();

      return view('admin.editPost', compact('post'));
   }

   //post edited admin post
   public function postEditPost(CreatePost $request, $id)
   {
      //go barame toj post
      $post = Post::where('id', $id)->first();

      // prenesuvame values
      $post->title = $request['title'];
      $post->content = $request['content'];
      $post->save();

      return back()->with('success', "Post updated successfully");
   }


   //admin post deleting
   public function deletePost($id)
   {
      $post = Post::where('id', $id)->first();

      if (!$post) {
         return back()->with('error', "Post does not exist");
      }

      $post->delete();

      return back()->with('success', "Post deleted successfully");
   }

   //get user to edit
   public function editUser($id)
   {
      $user = User::where('id', $id)->first();

      return view('admin.editUser', compact('user'));
   }

   //Post the edited user
   public function editUserPost(UserUpdate $request, $id)
   {
      $user = User::where('id', $id)->first();

      $user->name = $request['name'];
      $user->email = $request['email'];

      if ($request['author'] == 1) {
         $user->author = true;
      } elseif ($request['admin'] == 1) {
         $user->admin = true;
      }

      $user->save();

      return back()->with('success', "User updated successfully");
   }

   public function deleteUser($id)
   {
      $user = User::where('id', $id)->first();

      if (!$user) {
         return back()->with('error', "User does not exist");
      }

      $user->delete();

      return back()->with('success', "User deleted successfully");
   }

   //SHOP Actions down from here________________________________________________________________________________________

   public function products()
   {
      $products = Product::all();

      return view('admin.products', compact('products'));
   }

   public function newProduct()
   {
      return view('admin.newProduct');
   }

   public function newProductPost(Request $request)
   {
      $this->validate($request, [
         'title' => 'required|string',
         'description' => 'required',
         'thumbnail' => 'required|file',
         'price' => 'required'                              /*|regex:/^[0-9]+[\.[0-9][0-9]?)?$/*/

      ]);

      $product = new Product;

      $product->title = $request['title'];
      $product->description = $request['description'];
      $product->price = $request['price'];

      $thumbnail = $request->file('thumbnail');

      $fileName = $thumbnail->getClientOriginalName();
      $fileExtension = $thumbnail->getClientOriginalExtension();

      $thumbnail->move('product-images', $fileName);

      $product->thumbnail  = 'product-images/' . $fileName;

      $product->save();

      return back()->with('success', "New product successfully created.");
   }


   //get edit view
   public function editProduct($id)
   {
      $product = Product::where('id', $id)->first();

      if (!$product) {
         return back()->with('error', "Product does not exist");
      }

      return view('admin.editProduct', compact('product'));
   }


   //post edited product from the get view
   public function editProductPost(Request $request, $id)
   {
      $this->validate($request, [
         'title' => 'required|string',
         'description' => 'required',
         'thumbnail' => 'required|file',
         'price' => 'required'

      ]);

      $product = Product::findOrFail($id);

      $product->title = $request['title'];
      $product->description = $request['description'];
      $product->price = $request['price'];

      if ($request->hasFile('thumbnail')) {

         $thumbnail = $request->file('thumbnail');
         $fileName = $thumbnail->getClientOriginalName();
         $thumbnail->move('product-images', $fileName);
         $product->thumbnail  = 'product-images/' . $fileName;
      }

      $product->save();
      return back()->with('success', "Product successfully updated");
   }

   public function deleteProduct($id)
   {
      $product = Product::where('id', $id)->first();

      if (!$product) {
         return back()->with('error', "Product does not exist");
      }
      $product->delete();

      return back()->with('success', "Product deleted successfully");
   }
}
