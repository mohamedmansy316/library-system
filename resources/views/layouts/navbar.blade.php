<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Books</a>
          </li>
        </ul>
        @guest
            <a href="{{route('login')}}" rel="nofollow" class="login-link"><i class="fas fa-user"></i> Login</a>
        @endguest
        @auth
                <a href="{{route('profile')}}" rel="nofollow" class="login-link"><i class="fas fa-user"></i> Welcome, {{auth()->user()->name}}</a>
        @endauth
      </div>
      </div>
    </div>
  </nav>
  @if (session()->has('success'))

  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <h5 class="mt-1 mb-2">Success!</h5>
    <p>{{session('success')}}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if ($errors->any())

  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h5 class="mt-1 mb-2">Error!</h5>
    @foreach ($errors->all() as $error)
    <p class="mb-0">{{ $error }}</p>
    @endforeach    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
