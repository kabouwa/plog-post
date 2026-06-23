@extends('layouts.app')

@section('head')
@endsection

@section('title') Edit Post @endsection

@section('heading') Edit Post @endsection

@section('content')
{{-- the : before props is to say to blade evaluate the string as php  --}}
<x-post-form
    :action="route('posts.update', $post->id )"
    method="PUT" 
    :titleValue="$post['title']" 
    :descValue="$post['description']" 
    submitValue="Update" 
    submitColor="success"
/>
@endsection
