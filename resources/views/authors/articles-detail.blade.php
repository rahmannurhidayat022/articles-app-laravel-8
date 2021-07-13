@extends('layouts.authors')

@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-12">
   <div class="card">
    <div class="card-header d-flex justify-content-between bg-dark text-white">
     <h2 class="h2"><i class="bi bi-book"></i> Articles List</h2>
     <div class="action d-flex">
      <a href="{{ url('articles/edit/'.$data->id) }}" class="btn btn-warning mx-2">
       <i class="bi bi-pen"></i> Edit</a>
       <form action="{{ route('delete', ['id' => $data->id]) }}" method="POST">
         @csrf
         @method('delete')
         <input type="hidden" name="_method" value="DELETE">
        <button class="btn btn-danger ml-2" type="submit"><i class="bi bi-trash"></i> Delete</button>
       </form>
     </div>
    </div>

    <div class="card-body">
     @if (session('status'))
     <div class="alert alert-success" role="alert">
      {{ session('status') }}
     </div>
     @endif

     <div class="row">
      <div class="col-sm 12 col-md-12">
       <div id="{{ $data->id }}" class="card text-left my-2">
        <div class="card-body">
         <h3 class="card-title">{{ $data->title }}</h3>
         <span class="text-muted">Author : {{$data->author }}</span>
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
  <div class="col-md-12">
    <div id="comments" class="row my-4">
        <div class="col-sm-12">
            <div class="card p-4">
                <div class="card-title">
                    <h5>
                        Comments
                    </h5>
                </div>
                @foreach ($comments as $item)
                @if ($data->id == $item->article)
                <div id="{{ $item->id }}" class="comment">
                    <h6 class="h6 text-primary">Dari Author: {{ $item->author }}</h6>
                    <p>{{ $item->content }}</p>
                    <small class="text-muted">{{ $item->created_at }}</small>
                    <hr>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
 </div>
</div>
@endsection