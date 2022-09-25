@include('admin.layout.header')
<body>

@include('admin.layout.navbar')
@include('admin.layout.sidebar')

		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Basic Datatable</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display min-w850">
                                        <thead>
                                            <tr>
                                                <th>User name</th>
                                                <th>Book title</th>
                                                <th>ISBN</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($AllRequests as $Request)
                                            <tr>
                                                <td>{{$Request->User->name}}</td>
                                                <td>{{$Request->Book->title}}</td>
                                                <td>{{$Request->Book->isbn}}</td>
                                                <td>
                                                    {{-- <div class="d-flex">
                                                        <a href="{{route('admin.books.getEdit' , $Request->id)}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                        <a type="button" class="btn btn-danger shadow btn-xs sharp" data-toggle="modal" data-target="#exampleModal-{{$Request->id}}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                        <div class="modal fade" id="exampleModal-{{$Request->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are You Sure For Delete This Book
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <a href="{{route('admin.books.delete' , $Request->id)}}" class="btn btn-danger ">Delete</i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <a href="{{route('admin.books.delete' , $Request->id)}}" class="btn btn-danger ">Refuse</i></a>
                                                    <a href="{{route('admin.books.delete' , $Request->id)}}" class="btn btn-success ">Accept</i></a>
                                                </td>
                                            </tr>
                                            @empty

                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
            </div>
        </div>

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
@include('admin.layout.scripts')
</body>
</html>
