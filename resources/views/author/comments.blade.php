@extends('layouts.admin')

@section('title')Author Comments @endsection

@section('content')
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header bg-light">
            Author Comments
         </div>

         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Post</th>
                        <th>Content</th>
                        <th>Created at</th>

                     </tr>
                  </thead>
                  <tbody>

                     {{--Auth::user()->comments another way to get comments--}}
                     @foreach($comments as $comment)
                     <tr>

                        <td {{--class="text-nowrap"--}}>{{ $comment->id }}</td>
                        <td class="text-nowrap"><a href="{{ route('singlePost', $comment->id) }}">{{ $comment->post->title }}</a></td>
                        <td>{{ $comment->post->content }}</td>
                        <td>{{ date_format($comment->created_at,  'F d, Y') }}</td>

                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection