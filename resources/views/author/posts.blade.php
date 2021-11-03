@extends('layouts.admin')

@section('title') Author Posts @endsection

@section('content')
    <div class="content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    Author Posts
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

                            @foreach(Auth::user()->posts as $post)
                                <tr>

                                    <td {{--class="text-nowrap"--}}>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                                    <td>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</td>
                                    <td>{{ $post->comments->count() }}</td>
                                    <td>


                                        <a href="{{ route('postEdit', $post->id) }}" class="btn btn-warning">Edit</a>

                                       {{-- <a href="--}}{{--{{ route('postEdit', $post->id) }}--}}{{--" class="btn-danger">Remove</a>--}}

                                      {{--  <form id="deletePost-{{ $post->id }}" action="{{ route('deletePost', $post->id) }}" method="POST" >
                                            @csrf
                                            <button type="button" class="btn btn-danger"
                                                    onclick="document.getElementById('deletePost-{{ $post->id }}').submit()" >
                                                Remove
                                            </button>
                                        </form>--}}

                                         <form style="display: none" action="{{ route('deletePost', $post->id) }}" method="POST" >
                                             @csrf</form>
                                           {{--  @method('delete')--}}
                                             <button type="submit" class="btn btn-danger" >Remove</button>



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