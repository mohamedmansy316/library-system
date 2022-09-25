@include('layouts.header')

<body class="antialiased">
    @include('layouts.navbar')
    <section id="books">
        <div class="container">
            <div class="row">
                <div class="col-12 my-5">
                    <h1>All available books</h1>
                </div>
                @forelse ($AllBooks as $Book)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{$Book->Thumb}}" class="card-img-top">
                        <div class="card-body">
                            <h2 class="card-title">{{$Book->title}}</h2>
                            <small class="card-text d-inline-block bg-danger p-1 mb-2 text-white rounded">{{$Book->author}}</small>
                            <p class="card-text">{{$Book->BookDescription}}</p>
                            @auth
                            <a href="{{route('book.borrow', $Book->id)}}" class="btn btn-primary">Borrow</a>
                            @endauth
                        </div>
                    </div>
                </div>
                @empty
                <p>There's no books for now</p>
                @endforelse
            </div>
        </div>
    </section>
    @include('layouts.scripts')
</body>

</html>
