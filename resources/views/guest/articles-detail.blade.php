@extends('layouts.app')

@section('content')
 <div class="row justify-content-center">
  <div class="col-md-12">
   <div class="card">
       <div class="card-header">
           <h2 class="h2"><i class="bi bi-book"> </i>{{ $data->title }}</h2>
         <span class="text-muted">Author : {{$data->author }}</span>

       </div>

     <div class="row">
      <div class="col-sm 12 col-md-12">
       <div id="{{ $data->id }}" class="card text-left my-2">
        <div class="card-body">
         {{-- <h3 class="card-title">{{ $data->title }}</h3>
         <span class="text-muted">Author : {{$data->author }}</span> --}}
         <p class="card-text my-4">{!! $data->content !!}</p>
         <hr>
         <span class="text-muted">Writen at {{$data->created_at }} and Published at {{ $data->published_at }}</span>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
@endsection