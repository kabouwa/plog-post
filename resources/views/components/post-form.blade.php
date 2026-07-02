<form class="form" method="POST" action="{{ $action }}">
    @csrf
    @method($method)
    <div class="form-group mb-4">
        <label for="title" class="form-label">Title*</label>
        <div class="input-group">
            <span class="input-group-text">T</span>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{old('title', $titleValue) }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group mb-4">
        <label for="description" class="form-label">Description*</label>
        <div class="input-group">
            <span class="input-group-text">D</span>
            <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description',$descValue) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group mb-4">
        <label for="creator" class="form-label">Post Creator*</label>
        <div class="input-group">
            <span class="input-group-text">@</span>
            <select name="creator" id="creator" class="form-select @error('creator') is-invalid @enderror">
                <option value="" disabled selected>Choose post creator</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @selected($user->id == $creatorId)>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('creator')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4 my-1">
            <input type="submit" class="btn btn-{{ $submitColor }} w-100" value="{{ $submitValue }}">
        </div>
        @if($postId)
        <div class="col-12 col-md-6 col-lg-4 my-1">
            <button 
                type="button" 
                class="btn btn-outline-danger w-100" 
                data-bs-toggle="modal" 
                data-bs-target="#delete-post-{{ $postId }}-modal">
                <i class="bi bi-trash"></i> Delete
            </button>
        </div>
        @endif
    </div>
</form>