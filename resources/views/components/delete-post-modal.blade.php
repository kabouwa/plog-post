<button type="button" class="btn btn-outline-danger btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#delete-post-{{ $postId }}-modal-{{ $uniqueId }}"> <i class="bi bi-trash"></i> Delete</button>
<div class="modal fade" tabindex="-1" id="delete-post-{{ $postId }}-modal-{{ $uniqueId }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center display-2 fw-bold"><i class="bi bi-exclamation-circle text-danger"></i></h5>
                <div class="d-flex flex-column justify-center align-items-center">
                    <p class="my-0">Are you sure you want to delete this post?</p>
                    <p class="my-0">This action cannot be undone.</p>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6 my-2">
                        <button type="button" class="btn btn-outline-secondary w-100 py-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <form method="POST" action="{{ route('posts.destroy',$postId) }}" class="col-lg-6 my-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 py-3">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>