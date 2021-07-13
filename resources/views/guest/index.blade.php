@extends('layouts.app')

@section('content')
@if ($data != null)
<div class="row justify-content-center">
<div class="col-md-12">
    <div class="card border-0">

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="row">
                @foreach ($data as $item)
                <div class="col-sm 12 col-md-12">
                    <div id="{{ $item->id }}" class="card text-left my-2 border-0">
                        <div class="card-body p-0 m-0">
                            <p class="card-text p-0 m-0" style="font-size: 14px;font-weight: normal">
                                https://www.artikelku.com/guest/articles/{{ $item->id }} 
                                    <span class="text-muted"><i class="bi bi-caret-down-fill"></i></span></p>
                            <a href="{{ url('guest/articles/'.$item->id) }}" class="m-0 p-0 text-capitalize">
                                <h3 class="card-title" style="font-size: 20px;line-height: 1.3">{{ $item->title }}</h3>
                            </a>
                            <p class="card-text p-0 m-0" style="font-size: 14px;font-weight: normal">{!! $item->content !!}</p>
                            <small class="text-muted">Created at {{ $item->created_at }} and Published at {{ $item->published_at }}</small>
                            <hr>
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