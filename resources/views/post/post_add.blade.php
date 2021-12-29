@extends('layout.master')
@section('title','Post Add')
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
    <form action="/post" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Title</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ old('title') }}">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Cover Image</label>
        <div class="col-sm-9">
          <input type="file" class="form-control" name="images" placeholder="Images" accept="image/jpeg, image/png">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Content</label>
        <div class="col-sm-9">
          <textarea id="editor1" name="content">{{ old('content') }}</textarea>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-3">Category</div>
        <div class="col-sm-2">
          <select class="form-control" name="category">
            @foreach ($category as $row)
              <option value="{{ $row->id }}">{{ $row->cat_name }}</option>
           @endforeach  
          </select>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-3">Status</div>
        <div class="col-sm-2">
          <select class="form-control" name="status">
            <option value="0">Draft</option>
            <option value="1">Publish</option>
            <option value="2">Archive</option>
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

<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>

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