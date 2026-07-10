{{-- Modern Layout method --}}

<x-layouts.app
    title="Posts"
>
    <x-slot:head>
       <link rel="stylesheet" href="{{ asset('css/index.css') }}"> 
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
            <form action="" class="position-relative d-flex gap-3">
                <input class="form-control" type="search" name="q" placeholder="Search for a title" value="{{ request('q') }}" id="search">
                <button type="submit" class="btn btn-primary bg-primary" style="width:20%; cursor: pointer;">
                    <i class="bi bi-search text-white mx-auto"></i>
                </button>
                <ul class="position-absolute w-100 mt-2 rounded-3 py-1 dropdown-menu d-block overflow-hidden" id="search-results"></ul>
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
    <section class="row d-none" id="cards-view">
        @foreach ($posts as $post)
            <x-cards.post-card :post="$post" />
        @endforeach
    </section>
    @endif

    {{-- Table UI --}}
    <section class="overflow-auto mw-100">
        <table class="table table-hover mt-2 d-none" id="table-view">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
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
                <tr>
                    <td>{{ $post->id }}</td>
                    <td><img src={{ asset('storage/' . $post->image_path) }} alt="Post Image" class="rounded-circle table-img pointer"><span class="title">show image</span></td>
                    <td class="pointer" onclick="toview(event, '{{ route('posts.show', $post->id ) }}', true)">{{ $post->title }}<span class="title">more</span></td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at->format('F d, Y') }}</td>
                    <td>
                        <a class="btn btn-outline-primary btn-sm flex-grow-1" href={{ route('posts.show', $post->id ) }}> <i class="bi bi-eye"></i></a>
                        @can('update',$post)
                            <a class="btn btn-outline-warning btn-sm" href={{ route('posts.edit', $post->id ) }}> <i class="bi bi-pencil"></i></a>
                        @endcan
                        @can('delete',$post)
                            <button 
                                type="button" 
                                class="btn btn-outline-danger btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#delete-post-{{ $post->id }}-modal">
                                    <i class="bi bi-trash"></i>
                            </button>
                        @endcan 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    
    <section>
        {{ $posts->links() }}
    </section>
    <div class="img-preview w-100 h-100 d-flex align-items-center justify-content-center p-4">
        <div class="position-fixed text-white fs-2 pointer right-0 top-0">
            <i class="bi bi-x-lg m-3"></i>
        </div>
        <img class="rounded-2 mw-100 mh-100" src="" alt="Post Image">
    </div>



    <x-slot:modals>
        <div class="position-fixed bottom-0 end-0 m-1">
            <button id="go-up" type="button" class="btn btn-outline-primary" style="display: none">
                <i class="bi bi-arrow-up-circle"></i>
            </button>
        </div>

        @auth
            @foreach ($posts as $post)
                @can('delete',$post)
                    <x-modals.delete-post-modal :post="$post"/>
                @endcan
            @endforeach
        @endauth
    </x-slot:modals>

    <x-slot:scripts>
        <script src="{{ asset('js/index.js') }}"></script>
        <script src="{{ asset('js/posts/search.js') }}"></script>
    </x-slot:scripts>

</x-layouts.app>