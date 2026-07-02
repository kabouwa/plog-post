@extends('layouts.app')

@section('head')
@endsection

@section('title') Post @endsection

@section('heading') Post @endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->description }}</p>
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

    <div class="card mb-4">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Name : {{ $post->posted_by }}</h5>
            <p class="card-text">Email : {{ $post->email }}</p>
            <p class="card-text">Created At : {{ $post->created_at }}</p>
        </div>
    </div>
@endsection

@section('modals')
    <x-delete-post-modal :post="$post"/>
@endsection