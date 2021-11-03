@extends('layouts.admin')

@section('title')Admin Post Editing @endsection

@section('content')
<div class="content">

   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header bg-light">
                  <strong>Editing : {{ $post->title }}</strong>
               </div>

               @if(Session::has('success'))
               <div class="alert alert-success col-md-8">{{ Session::get('success') }}</div>
               @endif



               {{-- errori na star nacin --}}

               {{-- @if($errors->any())
                              <div class="alert alert danger">
                                  <ul>
                                      @foreach($errors->all() as $error)
                                          <li>{{ $error }}</li>
               @endforeach
               </ul>
            </div>
            @endif--}}

            <form action="{{ route('adminPostEditPost', $post->id) }}" method="POST">
               @csrf
               {{--@method('patch')--}}
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-8">
                        <div class="form-group">
                           <label for="normal-input" class="form-control-label">Title</label>
                           <input id="normal-input" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $post->title }}" placeholder="Post title">

                           @error('title')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror

                        </div>
                     </div>
                  </div>

                  <div class="row mt-4">
                     <div class="col-md-8">
                        <div class="form-group">
                           <label for="placeholder-input" class="form-control-label">Content</label>
                           <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="" cols="30" rows="10" value="{{ $post->content }}" placeholder="Post content">
                                            </textarea>

                           @error('content')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror

                        </div>
                     </div>
                  </div>

                  <button type="submit" class="btn btn-success">Update Post</button>

               </div>
            </form>
         </div>

      </div>
   </div>

</div>


</div>
@endsection