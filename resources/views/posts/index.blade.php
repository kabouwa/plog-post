{{-- Modern Layout method --}}

<x-layouts.app
    title="Posts"
>
    <x-slot:head>
       <link rel="stylesheet" href="{{ asset('css/posts/index.css') }}"> 
    </x-slot:head>

    <x-slot:heading>
        @auth
            Hey, {{ Auth::user()->name }}
        @else
            Discover
        @endauth
    </x-slot:heading>

    <div class="row">
        <div class="col-12 col-sm-8 col-lg-10 my-1 d-flex align-items-center gap-2 text-info-emphasis">
            Total posts : <strong>{{ $total }}</strong>
        </div>
        <div class="col-12 col-sm-4 col-lg-2  my-1 d-flex align-items-center">
            <button class="btn btn-sm btn-outline-secondary w-100" id="ui-switcher">
                <i class="bi bi-arrow-left-right"></i>
                Switch View
            </button>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-12">
            <form action="">
                <div class="input-group">
                    <input class="form-control" type="search" name="q" placeholder="Search for a title" value="{{ request('q') }}">
                    <span class="input-group-text bg-primary" style="width:20%; cursor: pointer;" onclick="$(this).closest('form').submit()">
                        <i class="bi bi-search text-white mx-auto"></i>
                    </span>
                </div>
            </form>
        </div>
    </div>

    @if( session()->has('alert') ) 
        <x-modals.alert 
            :type="session('type')"
            :accent="session('accent')"
        >
            {{ session('alert') }}
        </x-modals.alert>
    @endif

    {{-- @dd($posts) --}}
    @if (!count($posts))
        <section class="alert alert-danger my-5">
            No Posts <strong>Founded</strong> !
        </section>
    @else
    <section class="row d-none" id="posts-cards">
        @foreach ($posts as $post)
        <article class="col-12 col-sm-6 col-lg-4 p-2">
            <div class="card h-100 bg-transparent text-dark" data-view-link="{{ route('posts.show', $post->id ) }}">
                <div class="card-body" ondblclick="toview(event, '{{ route('posts.show', $post->id ) }}' )" >
                    <span class="badge bg-secondary mb-2">ID: {{ $post->id }}</span>

                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">
                        <strong>Posted by:</strong> {{ $post->user->name }} <br>
                        <strong>Created at:</strong> {{ $post->created_at->format('F d, Y') }}
                    </p>
                </div>
                @auth
                    @if(Auth::user()->id == $post->creator->id || Auth::user()->is_admin)
                        <div class="card-footer border-top d-flex gap-2">
                            {{-- <a class="btn btn-outline-primary btn-sm flex-grow-1" href="{{ route('posts.show', $post->id ) }}"> <i class="bi bi-eye"></i>    View</a> --}}
                            <a class="btn btn-outline-warning btn-sm flex-grow-1 edit-link" href="{{ route('posts.edit', $post->id ) }}"> <i class="bi bi-pencil"></i> Edit</a>
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
        @endforeach
    </section>
    @endif

    {{-- Table UI --}}
    <section class="overflow-auto mw-100">
        <table class="table table-hover mt-2 d-none" id="posts-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Posted By</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!count($posts))
                    <tr>
                        <td colspan="5" class="text-center py-5 fw-bold h5">
                            No Posts Founded !
                        </td>
                    </tr>
                @endif
                @foreach ($posts as $post)
                <tr onclick="toview(event, '{{ route('posts.show', $post->id ) }}', true)">
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at->format('F d, Y') }}</td>
                    <td>
                        {{-- <a class="btn btn-outline-primary btn-sm flex-grow-1" href="{{ route('posts.show', $post->id ) }}"> <i class="bi bi-eye"></i> View </a> --}}
                        @auth
                            @if(Auth::user()->id == $post->user->id || Auth::user()->is_admin)
                            <a class="btn btn-outline-warning btn-sm" href="{{ route('posts.edit', $post->id ) }}"> <i class="bi bi-pencil"></i></a>
                            <button 
                                type="button" 
                                class="btn btn-outline-danger btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#delete-post-{{ $post->id }}-modal">
                                    <i class="bi bi-trash"></i>
                            </button>
                            @endif
                        @endauth
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    
    <section>
        {{ $posts->links() }}
    </section>

    <x-slot:modals>
        <div class="position-fixed bottom-0 end-0 m-1">
            <button id="go-up" type="button" class="btn btn-outline-primary" style="display: none">
                <i class="bi bi-arrow-up-circle"></i>
            </button>
        </div>
        @foreach ($posts as $post)
            <x-modals.delete-post-modal :post="$post"/>
        @endforeach

    </x-slot:modals>

    <x-slot:scripts>
        <script src="{{ asset('js/posts/index.js') }}"></script>
    </x-slot:scripts>

</x-layouts.app>