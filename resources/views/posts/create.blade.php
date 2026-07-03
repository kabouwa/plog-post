<x-layouts.app
    title="Create Post"
    heading="Create Post"
>
    <x-slot:head>
        <style>
            textarea{
                min-height: 100px !important;
                max-height: 500px;
            }
        </style>
    </x-slot:head>

    <x-post-form 
        :action="route('posts.store')"
    />

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <x-slot:scripts>
        <script src="{{ asset('js/posts/form.js') }}"></script>
    </x-slot:scripts>
</x-layouts.app>