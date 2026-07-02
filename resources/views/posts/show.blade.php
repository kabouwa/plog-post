@extends('layouts.app')

@section('head')
<style>
    .card-header{
        background-image: url('/images/posts/background.png');
        background-position: center;
        background-size: cover
    }
</style>
@endsection

@section('title') Post @endsection

@section('heading') Post*{{ $post->id }} @endsection

@section('content')
    <div class="card mb-4 shadow-sm glass-card">
        <div class="card-header d-flex justify-content-between align-items-center overflow-hidden">
            <span class="fs-5 fw-semibold">Post Info</span>
            <span class="badge bg-secondary">#{{ $post->id }}</span>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text text-secondary">{{ $post->description }}</p>
            <hr>
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3 my-1">
                    <a class="btn btn-warning w-100" href="{{ route('posts.edit', $post->id ) }}"> <i class="bi bi-pencil"></i> Edit</a>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 my-1">
                    <button 
                        type="button" 
                        class="btn btn-outline-danger w-100" 
                        data-bs-toggle="modal" 
                        data-bs-target="#delete-post-{{ $post->id }}-modal">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm glass-card">
        <div class="card-header">
            <span class="fs-5 fw-semibold">Post Creator Info</span>
        </div>
        <div class="card-body">

            <div class="d-flex align-items-center mb-3">
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
    </div>

@endsection

@section('modals')
    <x-delete-post-modal :post="$post"/>
@endsection