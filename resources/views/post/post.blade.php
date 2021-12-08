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
              @include('layout.flash-message')
	            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
	            	<tr>
	            		<th>No</th>
	            		<th>Title</th>
                  <th>Status</th>
                  <th>#</th>
	            	</tr>
                </thead>
                <tfoot>
                  @foreach($listpost as $no => $data)
                  <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $data->title}}</td>
                    <td>
                      @if($data->status == 0) 
                        <button class="btn btn-sm btn-warning">Draft</button> 
                      @else 
                        <button class="btn btn-sm btn-success">Publish</button> 
                      @endif
                    </td>
                    <td>
                      <div class="d-inline">
                          <a href="{{ url('post_edit',$data->id) }}" class="btn btn-sm btn-info">Edit</a>  
                          <form action="{{ url('post/'.$data->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                              <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                          </form>
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