@extends('layouts.app')

@section('head')
<style>
    textarea{
        min-height: 100px !important;
        max-height: 500px;
    }
</style>
@endsection

@section('title') Create Post @endsection

@section('heading') Create Post @endsection


@section('content')
<x-post-form 
    :action="route('posts.store')"
/>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@endsection

@section('scripts')
    <script src="{{ asset('js/posts/form.js') }}"></script>
@endsection