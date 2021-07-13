@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h2 class="h2"><i class="bi bi-book"> </i>{{ $data->title }}</h2>
                <span class="text-muted">Author : {{$data->author }}</span>

            </div>

            <div class="row">
                <div class="col-sm 12 col-md-12">
                    <div id="{{ $data->id }}" class="card text-left my-2">
                        <div class="card-body">
                            <p class="card-text my-4">{!! $data->content !!}</p>
                            <hr>
                            <span class="text-muted">Writen at {{$data->created_at }} and Published at {{ $data->published_at }}</span>
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
    <div class="col-md-12">
        <div id="createComment" class="row my-2">
            <div class="col-sm-6">
                <div class="card p-3">
                    <div class="card-title">
                        <h5>Create Comment this page</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/comments/new')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name_comments" class="form-label">Author</label>
                                <input type="text" name="name_comments" class="form-control" id="name_comments">
                            </div>
                            <div class="mb-3">
                                <label for="txt_comments" class="form-label">Comment</label>
                                <textarea name="txt_comments" class="form-control" id="txt_comments" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="article" value="{{ $data->id }}">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection