{{-- Anonymous Component no class  --}}
@props([
    'comment'
])
<div class="modal fade" tabindex="-1" id="delete-comment-{{ $comment->id }}-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center display-2 fw-bold"><i class="bi bi-exclamation-circle text-danger"></i></h5>
                <div class="d-flex flex-column justify-center align-items-center">
                    <p class="my-0 mb-2 text-center">#{{ $comment->id }} - {{ $comment->body }}</p>
                    <p class="my-0 fw-bold mt-2">Are you sure you want to delete this comment ?</p>
                    <p class="my-0 text-danger">This action cannot be undone.</p>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6 my-2">
                        <button type="button" class="btn btn-outline-secondary w-100 py-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <form method="POST" action={{ route('comments.destroy', $comment->id) }} class="col-lg-6 my-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100 py-3">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>