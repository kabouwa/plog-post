@extends('layouts.app')

@section('head')
@endsection

@section('title') Posts @endsection

@section('heading') All Posts @endsection

@section('content')
    {{-- @dd($posts) --}}
    @if (!count($posts))
        <div class="alert alert-danger my-5">
            No Posts <strong>Founded</strong> !
        </div>
    @else
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-12 col-sm-6 col-lg-4 p-2">
            <div class="card h-100">
                <div class="card-body">
                    <span class="badge bg-secondary mb-2">ID: {{ $post["id"] }}</span>

                    <h5 class="card-title">{{ $post["title"] }}</h5>
                    <p class="card-text">
                        <strong>Posted by:</strong> {{ $post["posted_by"] }} <br>
                        <strong>Created at:</strong> {{ $post["created_at"] }}
                    </p>
                </div>
                <div class="card-footer bg-white border-top">
                    <a class="btn btn-outline-primary btn-sm" href="{{ route('posts.show', ['post' => $post["id"] ] ) }}"> <i class="bi bi-eye"></i> View </a>
                    <a class="btn btn-outline-warning btn-sm" href="{{ route('posts.edit', ['post' => $post["id"] ] ) }}"> <i class="bi bi-pencil"></i> Edit</a>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#del-modal-{{ $post["id"] }}"> <i class="bi bi-trash"></i> Delete</button>

                    <div class="modal fade" tabindex="-1" id="del-modal-{{ $post["id"] }}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <h5 class="text-center display-2 fw-bold"><i class="bi bi-exclamation-circle text-danger"></i></h5>
                                    <div class="d-flex flex-column justify-center align-items-center">
                                        <p class="my-0">Are you sure you want to delete this post?</p>
                                        <p class="my-0">This action cannot be undone.</p>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-6 my-2">
                                            <button type="button" class="btn btn-outline-secondary w-100 py-3" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                        <form method="POST" action="{{ route('posts.destroy',$post['id']) }}" class="col-lg-6 my-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100 py-3">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif


    {{-- Table UI --}}
    <table class="table table-hover py-5 mt-5 d-none">
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
                <td>{{ $post["id"] }}</td>
                <td>{{ $post["title"] }}</td>
                <td>{{ $post["posted_by"] }}</td>
                <td>{{ $post["created_at"] }}</td>
                <td>
                    {{-- <a href="{{ route('posts.show', $post["id"] ) }}" class="btn btn-outline-primary">View</a> --}}
                    {{-- <a href="/posts/{{ $post["id"] }}" class="btn btn-outline-primary">View</a> --}}
                    <a href="{{ route('posts.show', ['post' => $post["id"] ] ) }}" class="btn btn-outline-primary">View</a>
                    <a href="{{ route('posts.edit', ['post' => $post["id"] ] ) }}" class="btn btn-outline-warning">Edit</a>
                    <a href="#" class="btn btn-outline-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
