@extends('layouts.authors')

@section('content')
@if ($msg = Session::get('success'))
<div class="alert alert-success" role="alert">
 {{ $msg }}
</div>
@endif
@if ($msg = Session::get('failed'))
<div class="alert alert-danger" role="alert">
 {{ $msg }}
</div>
@endif
<div class="row d-flex justify-content-center mb-5">
 <div class="col-sm-6">
  <div class="card bg-light">
   <div class="card-title pt-3">
    <h1 class="d-flex justify-content-center"><span><i class="bi bi-person-circle"></i></span></h1>
   </div>
   <div class="card-body">
    <h4 class="text-center">My Profile</h4>
    <form action="" method="POST">
     @csrf
     <div class="form-floating mb-3">
      <label for="name_author">Name :</label>
      <input type="text" class="form-control" id="name_author" name="name_author" value="{{ Auth::user()->name }}">
    </div>
    <div class="form-floating mb-3">
     <label for="email_author">Email :</label>
      <input type="email" class="form-control" id="email_author" name="email_author" value="{{ Auth::user()->email }}">
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    </form>
   </div>
  </div>
 </div>
</div>
@endsection