{{-- Anonymous component (no-class) --}}
@props([])
<header class="fixed-top container mx-auto ">
    <nav class="navbar navbar-expand-lg text-white rounded-3 my-3 w-100 px-1" style="background-color: rgba(255, 255, 255, 0.85);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="Kabouwa Blog Logo" style="width: 2rem; height: 2rem;">
                <p class="m-0">Kabouwa Blog</p>
            </a>
            <button class="btn btn-sm p-1 rounded-1 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
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
                
                {{-- Buttons UI --}}
                <ul class="navbar-nav ms-auto d-none">
                    @auth
                        <li class="nav-item mx-auto d-flex justify-content-between gap-2">
                            <a class="btn btn-primary px-4 flex-grow-1 " href="{{ route('users.show', Auth::user()->id) }}">{{ Auth::user()->username }}'s profile</a>
                            {{-- <form method="POST" action="{{ route('logout') }}" class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger px-4 flex-grow-1">Logout</button>
                            </form> --}}
                            <button 
                                type="button" 
                                class="btn btn-outline-danger px-4 flex-grow-1"
                                data-bs-toggle="modal"
                                data-bs-target="#logout-modal"
                            >Logout</button>
                        </li>
                    @else
                        <li class="nav-item mx-auto d-flex justify-content-between gap-2">
                            <a class="btn btn-outline-secondary px-5 flex-grow-1 {{ request()->routeIs('login') ? 'disabled bg-secondary text-white'  : '' }}" href="{{ route('login') }}">Login</a>
                            <a class="btn btn-primary px-5 flex-grow-1 {{ request()->routeIs('register') ? 'disabled '  : '' }}" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>

                {{-- Dropdown UI --}}
                <div class="dropdown ms-auto my-2">
                    <button class="btn @auth btn-outline-primary @else btn-primary @endauth dropdown-toggle px-5" type="button" data-bs-toggle="dropdown">
                        @auth {{ Auth::user()->username }} @else Account  @endauth
                    </button>
                    <ul class="dropdown-menu w-100">
                        @auth
                            <li class="dropdown-header"><h6>Account</h6></li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('users.show') ? 'active' : '' }}" href="{{ route('users.show', Auth::user()->id) }}">
                                    <i class="bi bi-person-circle"></i>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('users.edit') ? 'active' : '' }}" href="{{ route('users.edit', Auth::user()->id) }}">
                                    <i class="bi bi-gear-fill"></i>
                                    Edit profile
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <button 
                                    type="button" 
                                    class="dropdown-item text-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#logout-modal"
                                ><i class="bi bi-box-arrow-right"></i>
                                Logout</button>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('login') ? 'active' : '' }}" href={{ route('login') }}>Login</a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('register') ? 'activr '  : '' }}" href={{ route('register') }}>Register</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>