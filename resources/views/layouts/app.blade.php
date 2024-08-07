<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Logo -->
        <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">

        <!-- Select2 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

        <!-- PrintJS -->
        <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">

        @vite(['resources/css/app.css'])

        <!-- Critical Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    </head>

    <body>
        @yield('main')

        <!-- Flash Messages -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
        <x-flashify::scripts />

        <!-- Non-critical Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js" defer></script>

        <!-- DataTables Core -->
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js" defer></script>

        <!-- DataTables Buttons -->
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js" defer></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js" defer></script>

        <!-- DataTables Buttons Extensions -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" defer></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js" defer></script>
        <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js" defer></script>

        <!-- Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- PrintJS -->
        <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

        <!-- App Scripts -->
        @vite(['resources/js/app.js'])

        @stack('scripts')
    </body>
</html>
