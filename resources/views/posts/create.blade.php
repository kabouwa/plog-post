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
<form class="form" method="POST" action="{{ route('posts.store') }}">
    @csrf
    <div class="form-group mb-4">
        <label for="title" class="form-label">Title*</label>
        <div class="input-group">
            <span class="input-group-text">T</span>
            <input type="text" class="form-control" name="title" id="title" required >
        </div>
    </div>
    <div class="form-group mb-4">
        <label for="description" class="form-label">Description*</label>
        <div class="input-group">
            <span class="input-group-text">D</span>
            <textarea type="text" class="form-control" name="description" id="description" required rows="3"></textarea>
        </div>
    </div>
    <div class="form-group mb-4">
        <label for="creator" class="form-label">Post Creator*</label>
        <div class="input-group">
            <span class="input-group-text">@</span>
            <select name="creator" id="creator" class="form-select" required>
                <option value="" disabled selected>Choose post creator</option>
                <option value="Mohammed">Mohammed</option>
                <option value="Ahmed"   >Ahmed</option>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
