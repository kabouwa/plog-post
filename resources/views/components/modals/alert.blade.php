@props([
    'type' => 'success',
    'accent' => '',
])
<div class="alert-compo alert alert-dismissible fade show my-3 alert-{{ $type }}" role="alert">
    <strong>{{ $accent }}!</strong> {{ $slot }}
    <button 
        type="button" 
        class="btn-close" 
        data-bs-dismiss='alert'
        aria-label="Close"
    ></button>
</div>