{{-- Static Components because we create manually without `php artisan make:Component` so no class no php logic for this component --}}
<footer class="bg-light my-0 py-3">
    <div class="container text-center">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 d-flex flex-column justify-content-center align-items-center">
                <img class="w-25" src={{ asset('images/logo.png') }} alt="Page logo">
                <p class="display-6 fw-bold fs-2">Kabouwa Blog</p>
            </div>
            <div class="col-12 col-md-6 col-lg-8">
                <p class="h3">Links:</p>
                <ul class="navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link rounded-4 px-3 border border-1{{ request()->routeIs('users.index') ? 'active bg-primary text-white' : '' }}" href="{{ route('users.index') }}">
                            <i class="bi bi-people-fill"></i> 
                            Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-4 px-3 border border-1 {{ request()->routeIs('posts.index') && !request()->filled('profile') ? 'active bg-primary text-white' : '' }}" href="{{ route('posts.index') }}">
                            <i class="bi bi-file-earmark-text-fill"></i> 
                            Posts
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link rounded-4 px-3 border border-1 {{ request()->routeIs('posts.index') && request()->filled('profile') ? 'active bg-primary text-white' : '' }}" href="{{ route('posts.index',['profile' => Auth::user()->username]) }}">
                                <i class="bi bi-file-earmark-text-fill"></i>
                                My posts
                            </a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link rounded-4 px-3 border border-1 {{ request()->routeIs('posts.create') ? 'active bg-primary text-white' : '' }}" href="{{ route('posts.create') }}">
                            <i class="bi bi-plus-circle-fill"></i> 
                            Create Post
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <small class="text-muted d-block mt-5">
                &copy; {{ date("Y") }} Kabouwa Blog - All rights reserved.
        </small>
    </div>
</footer>
