@extends('layouts.authors')

@section('title', 'Edit Article')

@section('content')
<div class="my-5">
  <h2 class="h3">Edit Articles</h2>
    <form action="" method="POST">
    @csrf
      <div class="mb-3">
      <label for="frm-title" class="form-label">Title</label>  
        <input class="form-control" type="text" value="{{ $data->title }}"
          name="frm-title" id="frm-title" placeholder="Article Title">
      </div>
      <div class="mb-3">
      <label for="frm-content" class="form-label">
        Content</label>
        <textarea name="frm-content" id="frm-content"
          class="form-control" cols="30" rows="10">
          {!! $data->content !!}
        </textarea>
      </div>
      <input type="hidden" name="created_at" value="{{ $data->created_at }}">
      <input type="hidden" name="published_at" value="{{ $data->published_at }}">
      <input type="hidden" name="author" value="{{ $data->author }}">
      <input type="hidden" name="id" value="{{ $data->id }}">
      <div class="mb-3">
      <button type="submit" class="btn btn-primary form-control">Perbaharui</button>
      </div>
    </form>
</div>
@endsection

@section('script')
    @parent
    <script>
      window.addEventListener('DOMContentLoaded', event => {
        tinymce.init({
          selector: 'textarea#frm-content',
          content_css: false,
          skin: false
        });
      });
    </script>
@endsection