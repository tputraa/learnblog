@extends('layout.master')
@section('title','Post List')
@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4>Post List</h4>
        </div>
        <div class="card-body">
        	<div class="float-left">

          		<a href="{{ url('post_add') }}" class="btn btn-primary mb-4"><i class="fas fa-edit"></i> Add Post</a>
      		</div>
          	<div class="table-responsive">
	            <table class="table table-striped">
                <thead>
	            	<tr>
	            		<th>No</th>
	            		<th>Judul</th>
                  <th>#</th>
	            	</tr>
                </thead>
                <tfoot>
                  @foreach($listpost as $no => $data)
                  <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $data->title}}</td>
                    <td><a href="" id="tes">a</a></td>
                  </tr>
                  @endforeach
                </tfoot>
	          	</table>
              {{ $listpost->links() }} 
            </div>
        </div>
      </div>
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