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
        <x-modals.alert
        type="danger"
        accent='Please fix the following issues'>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-modals.alert>
    @endif

    <x-slot:scripts>
        <script src="{{ asset('js/posts/form.js') }}"></script>
    </x-slot:scripts>
</x-layouts.app>