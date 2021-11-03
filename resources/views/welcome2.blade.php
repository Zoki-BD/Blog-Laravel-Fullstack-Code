<!-- @extends('layouts.master')


@section('content')
<!-- Page Header -->
<header class="masthead" style="background-image: url('{{ asset('assets/img/home-bg.jpg') }}')">
   <div class="overlay"></div>
   <div class="container">
      <div class="row">
         <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
               <h1>Probat</h1>
               <span class="subheading">A Blog From a Passionate Artist</span>
            </div>
         </div>
      </div>
   </div>
</header>

<!-- Main Content -->
<div class="container">
   <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">


         <h2>New Rental Form</h2>

         <form id="newRental">
            <div class="form-group">
               <label>Customer</label>
               <div class="tt-container">
                  <input id="customer" name="customer" data-rule-validCustomer="true" required type="text" value="" class="form-control" />
               </div>

            </div>

            <div class="form-group">
               <label>Movie</label>
               <div class="tt-container">
                  <input id="movie" name="movie" data-rule-atLeastOneMovie="true" type="text" value="" class="form-control" />
               </div>
            </div>

            <div class="row">
               <div class="col-md-4 col-sm-4">
                  <ul id="movies" class="list-group"></ul>
               </div>
            </div>



            <button class="btn btn-primary">Submit</button>
         </form>











         {{-- @foreach($posts as $post)
                      <div class="post-preview">

                          <a href="{{ route('singlePost', $post-> id )}}">
         <h2 class="post-title">
            {{ $post->title }}
         </h2>
         </a>
         <p class="post-meta">Posted by
            <a href="#">{{ $post->user->name }}</a>
            on {{ date_format($post->created_at,  'F d, Y') }}
            |
            <i class="fa fa-comment" aria-hidden="true"> </i> {{ $post->comments->count() }}
         </p>
      </div>
      <hr>
      @endforeach--}}
      <!-- Pager -->
      <div class="clearfix">

      </div>
   </div>
</div>
</div>
@endsection -->