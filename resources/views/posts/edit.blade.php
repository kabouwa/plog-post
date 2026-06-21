@extends('layouts.app')

@section('head')
@endsection

@section('title') Edit Post @endsection

@section('heading') Edit Post @endsection



@section('content')
<form class="form" method="POST" action="{{ route("posts.update", $post['id'] ) }}">
    @csrf
    @method('PUT')
    <div class="form-group mb-4">
        <label for="title" class="form-label">Title*</label>
        <div class="input-group">
            <span class="input-group-text">T</span>
            <input type="text" class="form-control" name="title" id="title" required value="{{ $post['title'] }}">
        </div>
    </div>
    <div class="form-group mb-4">
        <label for="description" class="form-label">Description*</label>
        <div class="input-group">
            <span class="input-group-text">D</span>
            <textarea type="text" class="form-control" name="description" id="description" required rows="3">{{ $post['description'] }}</textarea>
        </div>
    </div>
    <div class="form-group mb-4">
        <label for="creator" class="form-label">Post Creator*</label>
        <div class="input-group">
            <span class="input-group-text">@</span>
            <select name="creator" id="creator" class="form-select" required>
                <option value="" disabled >Choose post creator</option>
                <option value="Mohammed" {{ $post['posted_by'] === "Mohammed" ? "selected" : "" }}>Mohammed</option>
                <option value="Ahmed"    {{ $post['posted_by'] === "Ahmed"    ? "selected" : "" }}>Ahmed</option>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
