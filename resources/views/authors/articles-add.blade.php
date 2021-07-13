@extends('layouts.authors')

@section('title', 'New Article')

@section('content')
<div class="my-5">
 <h2 class="h2">New Articles</h2>
 <form action="" method="POST">
  @csrf
  <div class="mb-3">
   <label for="frm-title" class="form-label">Title</label>
   <input class="form-control" type="text" name="frm-title" id="frm-title" placeholder="Article Title">
  </div>
  <div class="mb-3">
   <label for="frm-content" class="form-label">
    Content</label>
   <textarea name="frm-content" id="frm-content" class="form-control" cols="30" rows="10"></textarea>
  </div>
  <div class="mb-3">
   <button type="submit" class="btn btn-primary form-control">Submit</button>
  </div>
 </form>
</div>
@endsection

@section('script')
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