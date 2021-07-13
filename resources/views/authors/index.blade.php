@extends('layouts.authors')

@section('title-page')
Articles    
@endsection

@section('content')
@if ($data != null)
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Writen</th>
                <th scope="col">Publish</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->author }}</td>
                <td>{{ $item->created_at }}</td>
                @if ($item->published_at == null)
                <td class="text-info">DRAF</td>
                @else
                <td>{{ $item->published_at }}</td>
                @endif
                <td>
                    <a class="btn btn-info btn-block" href="{{ url('/articles/detail/'.$item->id) }}">DETAIL</a>
                </td>
            </tr>
            @endforeach
            </tr>
        </tbody>
    </table>
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