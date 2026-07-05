<x-layouts.app
    title="Profiles"
>
    <x-slot:head>
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    </x-slot:head>

    <x-slot:heading>
        @auth
            Explore Profiles
        @else
            Register Now And Create Your Own Profile
        @endauth
    </x-slot:heading>
    .

    <div class="row">
        <div class="col-12 col-sm-8 col-lg-10 my-1 d-flex align-items-center gap-2 text-info-emphasis">
            Total Users : <strong>{{ $total }}</strong>
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
                    <input class="form-control" type="search" name="q" placeholder="Search for a user" value="{{ request('q') }}">
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
    @if (!count($users))
        <section class="alert alert-danger my-5">
            No Posts <strong>Founded</strong> !
        </section>
    @else
    <section class="row d-none" id="cards-view">
        @foreach ($users as $user)
        <article class="col-12 col-sm-6 col-lg-4 p-2">
            <div class="card h-100 bg-transparent text-dark" data-view-link={{ route('users.show', $user->id) }}>
                <div class="card-body" ondblclick="toview( event , '{{ route('users.show', $user->id) }}' )">
                    <div class="d-flex flex-row gap-2 align-items-center">
                        <img class="p-1 rounded-circle" src="https://picsum.photos/600/400?random={{ rand() }}" alt="User profile" style="width:100px;height:100px">
                        <h5 class="flex-grow-1 card-title d-flex flex-column">
                            {{ $user->name }}
                            <small class="text-muted">{{ $user->username }}</small>
                        </h5>
                        <span class="badge bg-secondary mb-2">ID: {{ $user->id }}</span>
                    </div>

                    <p class="card-text"> {{ $user->bio }} </p>
                </div>
                @auth
                    @if(Auth::user()->id == $user->id || Auth::user()->is_admin)
                        <div class="card-footer border-top d-flex gap-2">
                            {{-- <a class="btn btn-outline-primary btn-sm flex-grow-1" href="{{ route('posts.show', $post->id ) }}"> <i class="bi bi-eye"></i>    View</a> --}}
                            <a class="btn btn-outline-warning btn-sm flex-grow-1 edit-link" href="{{ route('users.edit',$user->id) }}"> <i class="bi bi-pencil"></i> Edit</a>
                            <button
                                type="button" 
                                class="btn btn-outline-danger btn-sm flex-grow-1 del-btn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#delete-user-{{ $user->id }}-modal">
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
        <table class="table table-hover mt-2 d-none" id="table-view">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!count($users))
                    <tr>
                        <td colspan="5" class="text-center py-5 fw-bold h5">
                            No User Founded !
                        </td>
                    </tr>
                @endif
                @foreach ($users as $user)
                <tr onclick="toview( event , '{{ route('users.show', $user->id) }}' , true )">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @auth
                            @if(Auth::user()->id == $user->id || Auth::user()->is_admin)
                            <a class="btn btn-outline-warning btn-sm" href={{ route('users.edit',$user->id) }}> <i class="bi bi-pencil"></i></a>
                            <button 
                                type="button" 
                                class="btn btn-outline-danger btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#delete-user-{{ $user->id }}-modal">
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
        {{ $users->links() }}
    </section>

    <x-slot:modals>
        <div class="position-fixed bottom-0 end-0 m-1">
            <button id="go-up" type="button" class="btn btn-outline-primary" style="display: none">
                <i class="bi bi-arrow-up-circle"></i>
            </button>
        </div>
        @auth
           @foreach ($users as $user)
                @if (Auth::user()->id == $user->id || Auth::user()->is_admin)
                    <x-modals.delete-user-modal :user="$user"/>
                @endif
            @endforeach 
        @endauth
    </x-slot:modals>

    <x-slot:scripts>
        <script src="{{ asset('js/index.js') }}"></script>
    </x-slot:scripts>

</x-layouts.app>