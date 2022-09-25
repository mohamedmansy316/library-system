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
                                <h4 class="card-title">Add new book</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.books.postCreate')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="text-black font-w500">Title</label>
                                            <input type="text" class="form-control" name="title">
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="text-black font-w500">slug</label>
                                            <input type="text" class="form-control" name="slug">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="text-black font-w500">Description</label>
                                            <textarea name="description" rows="9" class="form-control" id=""></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="text-black font-w500">Author</label>
                                            <input type="text" class="form-control" name="author">
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="text-black font-w500">ISBN</label>
                                            <input type="text" class="form-control" name="isbn">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="text-black font-w500">Image</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="text-black font-w500">Tags</label>
                                            <input type="text" class="form-control" name="tags">
                                        </div>
                                    </div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Create</button>
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
<script>
     var Slug;
            $('input[name="title"]').keyup(function() {
                Slug = $(this).val().replace(/[&\/\\#,+()$~%.'":*?<>{} ]/g, '-').replace(/[\[\]']/g,'-').replace(/--/g, '-').toLowerCase();
                $('input[name="slug"]').val(Slug);
            });
</script>
</body>
</html>
