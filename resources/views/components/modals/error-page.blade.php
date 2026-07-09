<div class="error-container w-100 h-100 d-flex flex-column align-items-center justify-content-center position-relative overflow-hidden">

    <div class="error-card text-center px-4 py-5 position-relative">

        <div class="error-status fw-bolder mb-2">
            <span class="text-dark">{{ $status[0] }}</span>
            <span class="text-danger status-glow">{{ $status[1] }}</span>
            <span class="text-dark">{{ $status[2] }}</span>
        </div>

        <div class="error-title display-5 fw-bold mb-3">
            {{ $title }}
        </div>

        <div class="error-description text-muted mb-4">
            {{ $message }}
        </div>

        <a href="{{ $href }}" class="btn btn-outline-primary btn-lg">
            {{ $button }}
        </a>
    </div>
    
</div>
<script> $('head title').text(`Kabouwa - {{ $title }} / {{ implode($status) }}`) </script>