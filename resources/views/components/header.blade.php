<header class="sticky-top">
    <nav class="navbar navbar-expand-sm bg-light-subtle text-white">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="Kabouwa Blog Logo" style="width: 2rem; height: 2rem;">
                <p class="m-0">Kabouwa Blog</p>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.index') }}">All Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.create') }}">Create Post</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>