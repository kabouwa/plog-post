<x-layouts.app
    :title="$user->username"
    :heading="$user->name"
>
    <x-slot:head>
        <style>
            .card-header{
                background-image: url('/images/posts/background.png');
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
            <div class="card-title d-flex flex-row align-items-center gap-4">
                <img class="p-1 rounded-circle" src="https://picsum.photos/600/400?random={{ rand() }}" alt="User profile" style="width:100px;height:100px">
                <div>
                   <h5>Username : {{ $user->username }}</h5>
                    <p class="text-muted">Contact : {{ $user->email }}</p> 
                </div>
            </div>
            <div class="card-text text-secondary mt-2"> Bio : {{ $user->bio }} </div>

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

    <x-slot:modals>
        <x-modals.delete-user-modal :user="$user"/>
    </x-slot:modals>

    <x-slot:scripts>
        <script src="{{ asset('js/posts/show.js') }}"></script>
    </x-slot:scripts>
</x-layouts.app>
