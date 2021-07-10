@extends('layouts.app')

@section('content')
@if ($data != null)
<div class="row justify-content-center">
<div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h2 class="h2">Articles</h2>
        </div>

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="row">
                @foreach ($data as $item)
                <div class="col-sm 12 col-md-6">
                    <div id="{{ $item->id }}" class="card text-left my-2">
                        <div class="card-body">
                            <a href="{{ url('guest/articles/'.$item->id) }}" class="nav-link p-0 text-dark">
                                <h3 class="card-title">{{ $item->title }}</h3>
                            </a>
                            <p class="card-text">{!! $item->content !!}</p>
                            <p class="card-text">Created at {{ $item->created_at }} and Published at {{ $item->published_at }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
@else
<div class="alert alert-primary" role="alert">
    <h4 class="alert-heading">Cache sedang dibersihkan!</h4>
    <p><strong>Pembersihan Cache bertujuan agar perubahan data dapat dilihat secara langsung</strong></p>
    <hr>
    <p class="mb-0">Silahkan <strong>Refresh Halaman</strong> anda, terimakasih</p>
</div>
@endif
@endsection