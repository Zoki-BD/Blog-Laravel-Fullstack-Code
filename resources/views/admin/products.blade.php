@extends('layouts.admin')

@section('title') Admin Products @endsection

@section('content')
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header bg-light">
            Admin Products
            <a href="{{ route('adminNewProduct') }}" class="btn btn-primary">New Product</a>
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
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>

                     {{--\App\Post::all() another way to get posts--}}
                     @foreach($products as $product)
                     <tr>

                        <td>{{ $product->id }}</td>
                        <td><img src="{{ asset($product->thumbnail)  }}" width="100"> </td>
                        <td>{{ $product->title  }}</td>
                        <td>{{$product->description }}</td>
                        <td>{{ $product->price }} USD</td>
                        <td>


                           <a href="{{ route('adminEditProduct', $product->id) }}" class="btn btn-warning">Edit Product</a>

                           {{--<a href="{{ route('postProduct', $post->id) }}" class="btn-danger">Remove</a>--}}

                           {{-- <form style="display: none" id="deletePost-{{ $post->id }}" action="{{ route('adminDeletePost', $post->id) }}" method="POST" >
                           @csrf </form>--}}
                           <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePostModal-{{ $product->id }}">
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

@foreach( $products as $product)
<!-- Modal -->
<div class="modal fade" id="deletePostModal-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">

            <h4 class="modal-title" id="myModalLabel">You are about to delete <strong>{{ $product->title}} </strong></h4>
         </div>
         <div class="modal-body">
            Are you sure?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No, keep it</button>

            <form id="deletePost-{{ $product->id }}" action="{{ route('adminDeleteProduct', $product->id) }}" method="POST">
               @csrf
               <button type="submit" class="btn btn-primary">Yes, delete it</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endforeach

@endsection