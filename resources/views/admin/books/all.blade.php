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
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Author</th>
                                                <th>ISBM</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($AllBooks as $Book)
                                            <tr>
                                                <td>{{$Book->title}}</td>
                                                <td>{{$Book->description}}</td>
                                                <td>{{$Book->author}}</td>
                                                <td>{{$Book->isbn}}</td>
                                                <td><img width="100px" src="{{$Book->Thumb}}" alt=""></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{route('admin.books.getEdit' , $Book->id)}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                        <a type="button" class="btn btn-danger shadow btn-xs sharp" data-toggle="modal" data-target="#exampleModal-{{$Book->id}}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                        <div class="modal fade" id="exampleModal-{{$Book->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <a href="{{route('admin.books.delete' , $Book->id)}}" class="btn btn-danger ">Delete</i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
