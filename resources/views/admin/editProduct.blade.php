@extends('layouts.admin')

@section('title') Admin Edit Product @endsection

@section('content')

<div class="content">

   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header bg-light">
                  <strong>EditProduct </strong>
               </div>

               @if(Session::has('success'))
               <div class="alert alert-success col-md-8">{{ Session::get('success') }}</div>
               @endif

               @if(Session::has('error'))
               <div class="alert alert-success col-md-8">{{ Session::get('error') }}</div>
               @endif



               {{-- @if($errors->any())
                              <div class="alert alert danger">
                                  <ul>
                                      @foreach($errors->all() as $error)
                                          <li>{{ $error }}</li>
               @endforeach
               </ul>
            </div>
            @endif--}}

            <form action="{{ route('adminEditProductPost', $product->id)}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="card-body">

                  <div class="row">
                     <div class="col-md-8">
                        <div class="form-group">
                           <label for="normal-input" class="form-control-label ">Thumbnail</label>
                           <input id="normal-input" type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" placeholder="Post title">

                           @error('thumbnail')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror

                        </div>
                     </div>
                     <img src="{{ asset($product->thumbnail)  }}" width="100" alt="">
                  </div>

                  <div class="row">
                     <div class="col-md-8">
                        <div class="form-group">
                           <label for="normal-input" class="form-control-label">Title</label>
                           <input id="normal-input" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $product->title }}" placeholder="Product title">

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
                           <label for="placeholder-input" class="form-control-label">Description</label>
                           <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="" cols="30" rows="4" placeholder="Product description">{{ $product->description }}
                           </textarea>

                           @error('description')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror

                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-8">
                        <div class="form-group">
                           <label for="normal-input" class="form-control-label">Price</label>
                           <input id="normal-input" name="price" value="{{ $product->price }}" class="form-control @error('price') is-invalid @enderror" placeholder="0.00 USD">

                           @error('price')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror

                        </div>
                     </div>
                  </div>

                  <button type="submit" class="btn btn-warning">Update Product</button>

               </div>
            </form>
         </div>

      </div>
   </div>

</div>


</div>

@endsection