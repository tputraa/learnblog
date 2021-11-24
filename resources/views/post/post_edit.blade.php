@extends('layout.master')
@section('title','Post Edit')
@section('content')
<style type="text/css">
  .form-group label{
    font-size: 13px !important;
  }
</style>
<div class="card">
  <div class="card-header">
    <h4>Add Post</h4>
  </div>
  <div class="card-body">
    <form action="{{ url('post/update/'.$post->id) }}" method="POST" enctype="multipart/form-data">
      @method('patch')
      @csrf
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Title</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{old('title',$post->title)}}" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Cover Image</label>
        <div class="col-sm-9">
          <input type="file" class="form-control" name="images" placeholder="Images" accept="image/jpeg, image/png">
          <br>
          @php if(isset($images->img_name)){
              $img = asset('/post_images/'.$images->img_name);
            } else{
              $img = asset('assets/img/example-image-50.jpg');
            }
          @endphp
          <img src="{{ $img }}" class="img-thumbnail" alt="Banner" style="width: 30% !important;height: auto;">
        </div>
        
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Content</label>
        <div class="col-sm-9">
          <textarea id="editor1" name="content" required>{{old('content',$post->content)}}</textarea>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-3">Category</div>
        <div class="col-sm-2">
          <select class="form-control" name="category">
            @foreach ($category as $row)
              <option value="{{ $row->id }}" {{ ( $row->id == $post->cat_id) ? 'selected' : '' }}>{{ $row->cat_name }}</option>
           @endforeach  
          </select>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-3">Status</div>
        <div class="col-sm-2">
          <select class="form-control" name="status">

            <option value="0" {{ ( $post->status == '0') ? 'selected' : '' }}>Draft</option>
            <option value="1" {{ ( $post->status == '1') ? 'selected' : '' }}>Publish</option>
            <option value="2" {{ ( $post->status == '2') ? 'selected' : '' }}>Archive</option>
          </select>
        </div>
      </div>
        <div class="card-footer">
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
    </form>
  </div>
</div>
@endsection


@push('page-scripts')
<link rel="stylesheet" href="{{asset('vendor/sweetalert2/sweetalert2.min.css')}}">
<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script>
        $(document).ready(function () {
           var editor1 = CKEDITOR.replace( 'editor1', {
                language: 'en',
                extraPlugins: 'notification'
            });

            // CKEDITOR.editorConfig = function( config ) {
            //   config.removePlugins = 'easyimage, cloudservices';
            // };

            editor1.on( 'required', function( evt ) {
                editor1.showNotification( 'This field is required.', 'warning' );
                evt.cancel();
            } );
        });
</script>
@endpush