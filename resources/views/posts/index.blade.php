@extends('layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/posts/index.css') }}">
@endsection

@section('title') Posts @endsection


@section('heading-color')white @endsection
@section('heading') Discover @endsection
@section('goback-color')white @endsection

@section('content')
    <button class="btn btn-outline-secondary text-white" id="ui-switcher">Switch View</button>
    {{-- @dd($posts) --}}
    @if (!count($posts))
        <section class="alert alert-danger my-5">
            No Posts <strong>Founded</strong> !
        </section>
    @else
    <section class="row d-none" id="posts-cards">
        @foreach ($posts as $post)
        <article class="col-12 col-sm-6 col-lg-4 p-2">
            <div class="card h-100 bg-transparent text-white">
                <div class="card-body" onclick="location.href = '{{ route('posts.show', $post->id ) }}' " >
                    <span class="badge bg-secondary mb-2">ID: {{ $post->id }}</span>

                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">
                        <strong>Posted by:</strong> {{ $post->posted_by }} <br>
                        <strong>Created at:</strong> {{ $post->created_at }}
                    </p>
                </div>
                <div class="card-footer  border-top d-flex gap-2">
                    {{-- <a class="btn btn-outline-primary btn-sm flex-grow-1" href="{{ route('posts.show', $post->id ) }}"> <i class="bi bi-eye"></i>    View</a> --}}
                    <a class="btn btn-outline-warning btn-sm flex-grow-1" href="{{ route('posts.edit', $post->id ) }}"> <i class="bi bi-pencil"></i> Edit</a>
                    <button 
                        type="button" 
                        class="btn btn-outline-danger btn-sm flex-grow-1" 
                        data-bs-toggle="modal" 
                        data-bs-target="#delete-post-{{ $post->id }}-modal">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </article>
        @endforeach
    </section>
    @endif

    {{-- Table UI --}}
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
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->posted_by }}</td>
                <td>{{ $post->created_at }}</td>
                <td>
                    {{-- <a class="btn btn-outline-primary btn-sm flex-grow-1" href="{{ route('posts.show', $post->id ) }}"> <i class="bi bi-eye"></i> View </a> --}}
                    <a class="btn btn-outline-warning btn-sm flex-grow-1" href="{{ route('posts.edit', $post->id ) }}"> <i class="bi bi-pencil"></i> Edit</a>
                    <button 
                        type="button" 
                        class="btn btn-outline-danger btn-sm flex-grow-1" 
                        data-bs-toggle="modal" 
                        data-bs-target="#delete-post-{{ $post->id }}-modal">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div id="go-up" class="position-fixed">
        <button type="button" class="btn btn-outline-primary text-white">
            <i class="bi bi-arrow-up-circle"></i>
        </button>
    </div>
@endsection

@section('modals')
    @foreach ($posts as $post)
        <x-delete-post-modal :post="$post"/>
    @endforeach
@endsection


@section('scripts')
<script src="{{ asset('js/posts/index.js') }}"></script>
@endsection