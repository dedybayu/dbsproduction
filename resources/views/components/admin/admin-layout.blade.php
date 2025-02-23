<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('/../img/logo-black.png') }}">
    <title>DBS Production</title>
</head>

<body>
    {{-- @include('admin.layout.navbar')
    @include('admin.layout.sidebar') --}}

    <x-admin.navbar></x-admin.navbar>
    <x-admin.sidebar></x-admin.sidebar>


    <main>
        <div class="p-4 sm:ml-64 mt-6">
            <x-header>{{$title}}</x-header>

            {{$slot}}
        </div>
    </main>

    <script src="js/file-upload.js"></script>
    <x-modal></x-modal>
</body>

</html>