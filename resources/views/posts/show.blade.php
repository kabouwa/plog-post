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
            :accent="session('accent') ?? 'Done'"
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
            @can('update',$post)
                <div class="card-footer bg-transparent">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-3 my-1">
                            <a class="btn btn-warning w-100" id="edit-link" href={{ route('posts.edit', $post->id ) }}> <i class="bi bi-pencil"></i> Edit</a>
                        </div>
                        @can('delete',$post)
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
                        @endcan
                    </div>
                </div> 
            @endcan
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

    
    {{-- Add Comments  --}}
    <div class="row">
        <form method="POST" action={{ route('comments.store') }} class="form">
            @csrf
            <input type="hidden" name="post_id" value={{ $post->id }}>
            <label for="comment" class="form-label">Add comment :</label>
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9 my-1">
                    <textarea 
                        name="comment" 
                        id="comment" 
                        class="form-control @error('comment') is-invalid @enderror" 
                        placeholder="I like your post"
                        rows="4"
                        >{{ old('comment') }}</textarea>
                    @error('comment')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-4 col-lg-3 my-1">
                    <button class="btn btn-outline-primary w-100" type="submit">Sent</button>
                </div>
            </div>
        </form>
    </div>  
    <hr>
    <p class="h1">Total comments : {{ $total }}</p>
    <div class="row">
        @foreach ($comments as $comment)
            <article class="my-2">
                <div class="card flex-row">
                    <div class="card-body w-100">
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
                    @can('update',$comment)
                    <div class="card-body d-flex flex-column align-items-center justify-content-center gap-2">
                        <button
                            type="button" 
                            class="btn btn-sm btn-outline-warning p-2 del-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#edit-comment-{{ $comment->id }}-modal">
                            <i class="bi bi-pencil"></i>
                        </button>
                        @can('delete',$comment)
                        <button
                            type="button" 
                            class="btn btn-sm btn-outline-danger p-2 del-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#delete-comment-{{ $comment->id }}-modal">
                            <i class="bi bi-trash"></i>
                        </button>
                        @endcan
                    </div>
                    @endcan
                </div>
            </article>
        @endforeach
    </div>
    <div class="row">
        {{ $comments->links() }}
    </div>

    @auth
    <x-slot:modals>
        @can('delete',$post)
            <x-modals.delete-post-modal :post="$post"/>
        @endcan

        @foreach ($comments as $comment)
            @can('update',$comment)
            <x-modals.edit-comment-modal :comment="$comment"/>
            @endcan
            @can('delete',$comment)
            <x-modals.delete-comment-modal :comment="$comment"/>
            @endcan
        @endforeach
    </x-slot:modals>
    @endauth

    <x-slot:scripts>
        <script src="{{ asset('js/show.js') }}"></script>
    </x-slot:scripts>
</x-layouts.app>
