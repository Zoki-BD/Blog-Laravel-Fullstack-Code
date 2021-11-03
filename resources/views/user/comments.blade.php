@extends('layouts.admin')

@section('title')
     User Comments
@endsection

@section('content')
    <div class="content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    User Comments
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
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach(Auth::user()->comments  as $comment)
                                <tr>

                                    <td {{--class="text-nowrap"--}}>{{ $comment->id }}</td>
                                    <td class="text-nowrap"><a href="{{ route('singlePost', $comment->id) }}">{{ $comment->post->title }}</a></td>
                                    <td>{{ $comment->post->content }}</td>
                                    <td>{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</td>
                                    <td>
                                        {{-- <form action="{{ route('deleteComment', $comment->id) }}" method="POST" >
                                             @csrf
                                            <button type="submit" class="btn btn-danger" >Delete comment </button>
                                         </form>--}}

                                        <form id="deleteComment-{{ $comment->id }}" action="{{ route('deleteComment', $comment->id) }}" method="POST" >
                                            @csrf
                                            <button type="button" class="btn btn-danger"
                                                    onclick="document.getElementById('deleteComment-{{ $comment->id }}').submit()" >
                                                Delete comment
                                            </button>
                                        </form>

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
    @endsection