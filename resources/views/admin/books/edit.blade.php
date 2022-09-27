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
				<!-- Add Order -->
				<div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Book <span class="text-danger">{{$TheBook->title}}</span></h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.books.postEdit', $TheBook->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="text-black font-w500">Title <span class="text-danger">*</span></label>
                                            <input type="text" value="{{old('title') ??  $TheBook->title}}" class="form-control" name="title" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="text-black font-w500">Description <span class="text-danger">*</span></label>
                                            <textarea  name="description" rows="9" class="form-control" id="" required>{{old('description') ??  $TheBook->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="text-black font-w500">Author <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{old('author') ??  $TheBook->author}}" name="author" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="text-black font-w500">Tags <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="tags" value="{{old('tags') ??  $TheBook->tags}}" required>
                                        </div>
                                    </div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</form>
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
