@extends('layouts.admin')

@section('title') Admin Posts @endsection

@section('content')
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header bg-light">
            Admin Posts
         </div>

         @if(Session::has('success'))
         <div class="alert alert-success ">
            {{ Session::get('success') }}
         </div>
         @endif

         @if(Session::has('error'))
         <div class="alert alert-danger ">
            {{ Session::get('error') }}
         </div>
         @endif

         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Comments</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>

                     {{--\App\Post::all() another way to get posts--}}
                     @foreach($posts as $post)
                     <tr>

                        <td {{--class="text-nowrap"--}}>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                        <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>
                        <td>{{ $post->comments->count() }}</td>
                        <td>


                           <a href="{{ route('adminPostEdit', $post->id) }}" class="btn btn-warning">Edit</a>

                           {{--<a href="{{ route('postEdit', $post->id) }}" class="btn-danger">Remove</a>--}}

                           {{-- <form style="display: none" id="deletePost-{{ $post->id }}" action="{{ route('adminDeletePost', $post->id) }}" method="POST" >
                           @csrf </form>--}}
                           <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePostModal-{{ $post->id }}">
                              Remove
                           </button>

                           {{--
                                        <form style="display: none" action="{{ route('adminDeletePost', $post->id) }}" method="POST" >
                           @csrf </form>--}}
                           {{-- @method('delete')--}}{{--
                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deletePostModal-{{ $post->id }}">Remove</button>--}}
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

@foreach( $posts as $post)
<!-- Modal -->
<div class="modal fade" id="deletePostModal-{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">

            <h4 class="modal-title" id="myModalLabel">You are about to delete <strong>{{ $post->title}} </strong>created by <strong>{{$post->user->name}}</strong></h4>
         </div>
         <div class="modal-body">
            Are you sure?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No, keep it</button>

            <form id="deletePost-{{ $post->id }}" action="{{ route('adminDeletePost', $post->id) }}" method="POST">
               @csrf
               <button type="submit" class="btn btn-primary">Yes, delete it</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endforeach

@endsection