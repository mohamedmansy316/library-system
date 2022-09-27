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
                                            <label class="text-black font-w500">Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title" required>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="text-black font-w500">slug <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="slug" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="text-black font-w500">Description <span class="text-danger">*</span></label>
                                            <textarea name="description" rows="9" class="form-control" id="" required></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="text-black font-w500">Author <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="author" required>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="text-black font-w500">ISBN <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="isbn" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="text-black font-w500">Image <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" name="image" required>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="text-black font-w500">Tags <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="tags" placeholder="Separate between tags by hyphens" >
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
