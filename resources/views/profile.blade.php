@include('layouts.header')
<body class="antialiased">
    @include('layouts.navbar')
    <section>
        <div class="container">
            <div class="row">
                <h1 class="my-4">My Orders</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse (auth()->user()->Orders as $Order)
                        <tr>
                            <td>{{$Order->id}}</td>
                            <td>{{$Order->Book->title}}</td>
                            <td>{{$Order->Book->isbn ?? 'N/A'}}</td>
                            <td>{{$Order->status}}</td>
                            <td>{{$Order->created_at->format('d M, Y')}}</td>
                            <td>
                                @if ($Order->status == 'pending')
                                <a href="{{route('book.borrow.cancel', $Order->id)}}">Cancel</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <p>There's no orders yet</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @include('layouts.scripts')
    </body>
</html>
