<header class="fixed-top container mx-auto ">
    <nav class="navbar navbar-expand-sm text-white rounded-3 my-3 w-100 px-1" style="background-color: rgba(255, 255, 255, 0.85);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="Kabouwa Blog Logo" style="width: 2rem; height: 2rem;">
                <p class="m-0">Kabouwa Blog</p>
            </a>
            <button class="btn btn-sm navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">All Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.create') }}">Create Post</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item mx-auto d-flex justify-content-between gap-2">
                            <a class="btn btn-outline-secondary px-4 flex-grow-1" href="{{ route('posts.index',['profile' => Auth::user()->username]) }}">My posts</a>
                            <a class="btn btn-outline-danger px-4 flex-grow-1" href="{{ route('logout') }}">Logout</a>
                        </li>
                    @else
                        <li class="nav-item mx-auto d-flex justify-content-between gap-2">
                            <a class="btn btn-outline-secondary px-5 flex-grow-1" href="{{ route('login') }}">Login</a>
                            <a class="btn btn-primary px-5 flex-grow-1" href="">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>