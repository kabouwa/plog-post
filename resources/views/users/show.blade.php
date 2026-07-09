<x-layouts.app
    :title="$user->username"
    :heading="$user->name"
>
    <x-slot:head>
        <style>
            .card-header{
                background-image: url('/images/backgrounds/background.png');
                background-position: center;
                background-size: cover
            }
        </style>
    </x-slot:head>

    @if( session()->has('alert') ) 
        <x-modals.alert 
            :type="session('type')"
            :accent="session('accent')"
        >
            {{ session('alert') }}
        </x-modals.alert>
    @endif
    
    <article class="card mb-4 shadow-sm glass-card">
        <div class="card-header d-flex justify-content-between align-items-center overflow-hidden">
            <span class="fs-5 fw-semibold">User Profile</span>
            <span class="badge bg-secondary">#{{ $user->id }}</span>
        </div>
        <div class="card-body">

            <div class="card-text text-center">
                <img class="p-1 mb-3 rounded-circle w-25 mw-100" src={{ asset('storage/' . $user->profile_path) }} alt="User profile" >
                <p class="h5 m-0">{{ '@' . $user->username }}</p>
                <p class="text-dark m-0">Created at : {{ $user->created_at->format('d-m-Y') }}</p>
                <p class="text-dark m-0">Email : <a href="mailto:{{ $user->email }}" class="nav-link d-inline">{{ $user->email }}</a></p> 
                <p class="text-secondary m-0">Bio : {{ $user->bio }} </p>   
            </div>

            <hr>
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3 my-1">
                    <a class="btn btn-outline-success w-100" href="{{ route('posts.index',['profile'=>$user->username]) }}"> <i class="bi bi-file-text"></i> {{ $user->username }}'s Posts</a>
                </div>
                @auth
                    @if(Auth::user()->id == $user->id || Auth::user()->is_admin)
                            <div class="col-12 col-sm-6 col-lg-3 my-1">
                                <a class="btn btn-warning w-100" id="edit-link" href="{{ route('users.edit', $user->id) }}"> <i class="bi bi-pencil"></i> Edit</a>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 my-1">
                                <button 
                                    type="button" 
                                    class="btn btn-outline-danger w-100" 
                                    id="del-btn"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#delete-user-{{ $user->id }}-modal">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                    @endif
                @endauth
            </div>
        </div>
    </article>

    <p class="h1">Posts : </p>
        {{-- @dd($posts) --}}
        @empty(count($posts))
            <section class="alert alert-danger my-5">
                No Posts <strong>Founded</strong> !
            </section>
        @else
            <section class="row">
                @foreach ($posts as $post)
                    <x-cards.post-card :post="$post" />
                @endforeach
            </section>
        @endempty

    <x-slot:modals>
        <x-modals.delete-user-modal :user="$user"/>
        @foreach ($posts as $post)
            <x-modals.delete-post-modal :post="$post" />
        @endforeach
    </x-slot:modals>

    <x-slot:scripts>
        <script src="{{ asset('js/show.js') }}"></script>
    </x-slot:scripts>
</x-layouts.app>
