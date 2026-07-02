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
@endsection
