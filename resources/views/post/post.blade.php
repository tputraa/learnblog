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
                    <td>
                      <div>
                          <a href="{{ url('post_edit',$data->id) }}" class="btn btn-sm btn-info">Edit</a>  
                      </div>
                    </td>
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