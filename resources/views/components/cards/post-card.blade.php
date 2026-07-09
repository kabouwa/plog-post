@props([
    'post' => null,
])
<article class="col-12 col-sm-6 col-lg-4 p-2">
    <div class="card h-100 bg-transparent text-dark" data-view-link={{ route('posts.show', $post->id ) }}>
        <img class="card-img p-1 rounded-3 pointer" src={{ asset( 'storage/' .  $post->image_path)  }} alt="Post picture" onclick="toview(event, '{{ route('posts.show', $post->id ) }}' )" >

        <div class="card-body" >
            <span class="badge bg-secondary mb-2">ID: {{ $post->id }}</span>
            <h5 class="card-title">
                {{ $post->title }}
                <a class="text-decoration-none text-muted" href={{ route('posts.show', $post->id ) }}>more...</a>
            </h5>
            <p class="card-text">
                <strong>Posted by:</strong> {{ $post->user->name }} <br>
                <strong>Created at:</strong> {{ $post->created_at->format('F d, Y') }}
            </p>
        </div>
        @auth
            @if(Auth::user()->id == $post->creator->id || Auth::user()->is_admin)
                <div class="card-footer border-top d-flex gap-2">
                    {{-- <a class="btn btn-outline-primary btn-sm flex-grow-1" href="{{ route('posts.show', $post->id ) }}"> <i class="bi bi-eye"></i>    View</a> --}}
                    <a class="btn btn-outline-warning btn-sm flex-grow-1 edit-link" href={{ route('posts.edit', $post->id ) }}> <i class="bi bi-pencil"></i> Edit</a>
                    <button
                        type="button" 
                        class="btn btn-outline-danger btn-sm flex-grow-1 del-btn" 
                        data-bs-toggle="modal" 
                        data-bs-target="#delete-post-{{ $post->id }}-modal">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            @endif
        @endauth
    </div>
</article>