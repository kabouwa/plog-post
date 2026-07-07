<x-layouts.app>
    
    <x-slot:head> -
        <link rel="stylesheet" href="{{ asset('css/error-page.css') }}">
    </x-slot:head>

    <x-modals.error-page :status="419"></x-modals.error-page>

</x-layouts.app>