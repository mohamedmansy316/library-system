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
                                                    <a href="{{route('admin.reverse.accept' , $Request->id)}}" class="btn btn-success ">Accept</i></a>
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
