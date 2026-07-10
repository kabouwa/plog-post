{{-- Anonymous Component no class  --}}
@props([
    'comment'
])
<div class="modal fade" tabindex="-1" id="edit-comment-{{ $comment->id }}-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center display-2 fw-bold border border-3 rounded-circle d-inline-block p-3 mx-auto" style="wid"><i class="bi bi-pencil tetx-warning"></i></h5>
                <form method="POST" action={{ route('comments.update', $comment->id) }}>
                    @csrf
                    @method('PUT')
                    <div class="d-flex flex-column justify-center align-items-center">
                        <p class="my-0 mb-2 text-center">#Comment No: {{ $comment->id }}</p>
                        <textarea class="form-control" name="comment" id="comment" rows="5">{{ $comment->body }}</textarea>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-6 my-2">
                            <button type="button" class="btn btn-outline-secondary w-100 py-3" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-lg-6 my-2">
                            <button type="submit" class="btn btn-warning w-100 py-3">Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>