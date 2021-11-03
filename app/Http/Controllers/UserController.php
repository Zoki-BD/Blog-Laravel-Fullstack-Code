<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Comment;
use App\Http\Requests\UserUpdate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        //kreirame instance na klasata DChart
        $chart = new DashboardChart();

        $days =$this->generateDateRange(Carbon::now()->subDays(30),Carbon::now());

        $comments = [];

        foreach ($days as $day) {
            $comments [] = Comment::whereDate('created_at', $day)->where('user_id', Auth::id())->count();
        }


        $chart->dataset('Comments', 'line', $comments);

        $chart->labels($days);

      return view('user.dashboard', compact('chart'));
    }

    //mora da kreirame function za odreduvanje na kolkav vreme.period da crpi chartot
    private function generateDateRange(Carbon $start_date, Carbon $end_date)
    {
            $dates = [];

            for($date = $start_date; $date->lte($end_date); $date->addDay()) {
                $dates[] = $date->format('Y-m-d');
            }

            return $dates;
    }

    //get comments
    public function comments()
    {
        return view('user.comments');
    }

    //post new comment
    public function newComment(Request $request)
    {
        $comment = new Comment();

        $comment->post_id = $request['post'];
        $comment->user_id = Auth::id();
        $comment->content = $request['comment'];

    $comment->save();

    return back();

    }


    public function deleteComment($id)
    {
        $comment = Comment::where('id', $id)->where('user_id', Auth::id())->delete();

        return back();
    }

    //get profile action
    public function profile()
    {
        return view('user.profile');
    }

    //post profile action
    public function profilePost(UserUpdate $request )
    {
        $user = Auth::user();

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        if($request['password'] != "") {
            if(!(Hash::check($request['password'], Auth::user()->password))) {
               return redirect()->back()->with('error', "Your current password does not match with the password provided.");
            }

          if(strcmp($request['password'], $request['new_password']) == 0) {
                return redirect()->back()->with('error', "New password cannot be same as your current password.");
          }

          $validation = $request->validate([
              'password' => 'required',
              'new_password' => 'required|string|min:6|confirmed'
          ]);


         $user->password = bcrypt($request['new_password']);
         $user->save();

            return redirect()->back()->with('success', "Password changed successfully.");
        }

      return back();
    }


}
