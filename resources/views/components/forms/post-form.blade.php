{{-- Class Component --}}
<div class="row">   
    <form class="form col-12 col-lg-7 my-1" method="POST" action={{ $action }} enctype="multipart/form-data">
        @csrf
        @method($method)
        <div class="form-group mb-4">
            <label for="title" class="form-label">Title*</label>
            <div class="input-group">
                <span class="input-group-text">T</span>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value={{ old('title', $titleValue) }}>
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
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description',$descValue) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group mb-4">
            <label for="image" class="form-label">Image*</label>
            <div class="input-group">
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" rows="3">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        {{-- <div class="form-group mb-4">
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
        </div> --}}
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
    <div class="col-12 col-lg-5 my-1 p-3 border border-2" id="preview">
        <h3>Post Preview</h3>
        <label for="image" class="w-100 position-relative">
            <img src={{ $imgPath }} alt="Post Image" class="rounded-2 w-100 mw-100">
            <div class="upload-banner glass-card d-flex justify-content-center align-items-center w-100 h-100 position-absolute top-0 left-0 rounded-2 h1 text-shadow text-white">
                <i class="bi bi-upload me-3"></i>
                Upload
            </div>
        </label>
    </div>
</div>