@extends('layouts.app')

@section('content')
@if ($data != null)
<div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item text-white">
                <h4>Dashboard</h4>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ url('/home') }}">
                <span><i class="bi bi-card-checklist"></i></span>
                Articles
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ url('/articles/new') }}">
                <span><i class="bi bi-file-earmark-plus"></i></span>
                Create Articles
              </a>
            </li>
          </ul>
        </div>
      </nav>
  
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 bg-white">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Articles</h1>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Author</th>
                <th scope="col">Title</th>
                <th scope="col">Writen</th>
                <th scope="col">Publish</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
              <tr>
                    <td>#</td>
                    <td>{{ $item->author }}</td>
                    <td>{{ $item->title }}</td>
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
      </main>
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