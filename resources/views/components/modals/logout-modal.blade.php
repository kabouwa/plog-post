{{-- Anonymous Component no class  --}}
@props([])
<div class="modal fade" tabindex="-1" id="logout-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Log out</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center display-2 fw-bold"><i class="bi bi-exclamation-circle text-danger"></i></h5>
                <div class="d-flex flex-column align-items-center text-center">
                    <p class="mb-2">Are you sure you want to <strong class="text-danger">log out</strong> from your account ?</p>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-6 my-2">
                        <button type="button" class="btn btn-outline-secondary w-100 py-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="col-lg-6 my-2">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 py-3">Log out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>