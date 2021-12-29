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
                          <a href="{{ url('post_edit',$data->id) }}" class="badge badge-info">Edit</a>  
                          <a class="badge badge-danger swal-confirm" data-id="{{ $data->id }}" id="del" type="submit" style="color: white;">
                            <form action="{{ route('post.destroy',$data->id) }}" data-id="{{ $data->id }}" method="post" id="delete{{ $data->id }}" class="d-inline">
                              @csrf
                              @method('delete')
                            </form>
                            Delete
                          </a>
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

@push('page-scripts')
<link rel="stylesheet" href="{{asset('vendor/sweetalert2/sweetalert2.min.css')}}">
<script src="{{asset('vendor/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript">
  $('#del').click(function(e){
      id = e.target.dataset.id;

      Swal.fire({
        title: 'Are you sure to delete? '+id,
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result) {
          $(`#delete${id}`).submit();
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }else{
          Swal('Tidak Jadi');
        }
      });
  });
</script>

@endpush