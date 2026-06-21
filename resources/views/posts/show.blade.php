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
            <h5 class="card-title">{{ $posts["title"] }}</h5>
            <p class="card-text">{{ $posts["description"] }}</p>
            <a href="/posts" class="btn btn-primary">Go Back</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Name : {{ $posts["posted_by"] }}</h5>
            <p class="card-text">Email : {{ $posts["email"] }}</p>
            <p class="card-text">Created At : {{ $posts["created_at"] }}</p>
        </div>
    </div>
@endsection
