<x-layouts.app
    title="Edit Post"
    heading="Edit Post"
>
    <x-slot:modals>
        <x-modals.delete-post-modal :post="$post"/>
    </x-slot:modals>

    {{-- the : before props is to say to blade evaluate the string as php  --}}
    <x-post-form
        :action="route('posts.update', $post->id )"
        method="PUT"
        :titleValue="$post['title']" 
        :descValue="$post['description']" 
        submitValue="Update" 
        submitColor="success"
        :postId="$post->id"
        :creatorId="$post->user_id"
    />

    @if ($errors->any())
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