@extends('layouts.admin')

@section('title')Admin User Editing @endsection

@section('content')
<div class="content">

   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header bg-light">
                  <strong>Editing : {{ $user->name }}</strong>
               </div>

               @if(Session::has('success'))
               <div class="alert alert-success col-md-8">{{ Session::get('success') }}</div>
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

            <form action="{{ route('adminEditUserPost', $user->id) }}" method="POST">
               @csrf
               {{--@method('patch')--}}
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-10">
                        <div class="form-group">
                           <label for="normal-input" class="form-control-label">Name</label>
                           <input id="normal-input" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">

                           @error('name')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror

                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-10">
                        <div class="form-group">
                           <label for="normal-input" class="form-control-label">Email</label>
                           <input id="normal-input" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">

                           @error('email')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                           @enderror

                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-10">
                        <div class="form-group">
                           <label for="normal-input" class="form-control-label">Permissions</label>
                           <input type="checkbox" name="author" class="form-control" value=1 {{ $user->author == true ? 'checked' : ''  }}>Author
                           <br>
                           <input type="checkbox" name="admin" class="form-control" value=1 {{ $user->admin == true ? 'checked' : ''  }}>Admin

                        </div>
                     </div>
                  </div>


                  <button type="submit" class="btn btn-success">Update User</button>

               </div>
            </form>
         </div>

      </div>
   </div>

</div>


</div>
@endsection