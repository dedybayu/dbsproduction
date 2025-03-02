<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('/../img/logo-black.png') }}">
    <title>DBS Production</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

</head>

<body>
    {{-- @include('admin.layout.navbar')
    @include('admin.layout.sidebar') --}}

    <x-user.navbar></x-user.navbar>
    <x-user.sidebar></x-user.sidebar>


    <main>
        <div class="p-4 sm:ml-64 mt-6">
            <x-header>{{$title}}</x-header>

            {{$slot}}
        </div>
    </main>


    <x-modal></x-modal>
    <script src="/../js/file-upload.js"></script>
    <script src="/../js/delete-post.js"></script>
    <script src="/../js/delete-category.js"></script>
    <script src="/../js/edit-category.js"></script>
</body>

</html>