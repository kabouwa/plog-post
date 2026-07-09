<x-layouts.app
    :title="$post->title"
    :heading="'Post*'.$post->id"
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
            <span class="fs-5 fw-semibold">Post Info</span>
            <span class="badge bg-secondary">#{{ $post->id }}</span>
        </div>
        <div class="card-body row">
            <div class="col-12 col-md-6 col-lg-5">
                <img src={{ asset( 'storage/' . $post->image_path) }} class="rounded-2 w-100 mw-100" alt="Post Image">
            </div>
            <div class="col-12 col-md-6 col-lg-7 d-flex flex-column justify-content-center my-2">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text text-secondary ms-2">{{ $post->description }}</p>
            </div>
        </div>
        @auth
            @if(Auth::user()->id == $post->creator->id || Auth::user()->is_admin)
            <div class="card-footer bg-transparent">
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-3 my-1">
                        <a class="btn btn-warning w-100" id="edit-link" href={{ route('posts.edit', $post->id ) }}> <i class="bi bi-pencil"></i> Edit</a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3 my-1">
                        <button 
                            type="button" 
                            class="btn btn-outline-danger w-100" 
                            id="del-btn"
                            data-bs-toggle="modal" 
                            data-bs-target="#delete-post-{{ $post->id }}-modal">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
            @endif
        @endauth
    </article>

    <article class="card mb-4 shadow-sm glass-card">
        <div class="card-header">
            <span class="fs-5 fw-semibold">Post Creator Info</span>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center mb-3" onclick="toview(event , '{{ route('users.show', $post->user->id) }}' )" style="cursor: pointer">
                <div class="bg-primary-subtle text-primary-emphasis rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                    <i class="bi bi-person-fill fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-0">{{ $post->user->name }}</h6>
                    <small class="text-secondary">{{ $post->creator->email }}</small>
                </div>
            </div>

            <p class="card-text mb-0">
                <i class="bi bi-clock text-secondary"></i>
                Created at {{ $post->created_at->format('H:i - D d F Y') }}
            </p>
        </div>
    </article>

    <p class="h1">Comments :</p>
    <div class="row">
        @foreach ($comments as $comment)
            <article class="my-2">
                <div class="card flex-row">
                    <div class="card-body flex-grow-1">
                        <div class="d-flex align-items-center gap-3">
                            <img class="rounded-circle border border-3 p-2" src={{ asset('storage/' . $comment->user->profile_path ) }} alt="User profile" style="width: 40px;height: 40px;">
                            <p class="fw-bold">
                                {{ $comment->user->username }}
                                <i class="bi bi-clock text-secondary ms-2"></i>
                                {{ $comment->created_at->format('d M H:i') }}
                            </p>
                        </div>
                         <p>{{ $comment->body }}</p>
                    </div>
                    @auth
                        @if (Auth::user()->is_admin || Auth::user()->id  === $comment->user_id)
                            <div class="card-body d-flex flex-column align-items-center justify-content-center gap-2">
                                <a class="btn btn-sm btn-outline-warning" href="#"><i class="bi bi-pencil"></i></a>
                                <a class="btn btn-sm btn-outline-danger" href=""><i class="bi bi-trash"></i></a>
                            </div>    
                        @endif
                    @endauth
                </div>
            </article>
        @endforeach
    </div>

    <x-slot:modals>
        <x-modals.delete-post-modal :post="$post"/>
    </x-slot:modals>

    <x-slot:scripts>
        <script src="{{ asset('js/show.js') }}"></script>
    </x-slot:scripts>
</x-layouts.app>
