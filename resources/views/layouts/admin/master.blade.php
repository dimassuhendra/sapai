<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        #wrapper { display: flex; align-items: stretch; }
        #sidebar-wrapper { min-height: 100vh; width: 250px; background: #212529; transition: all 0.3s; }
        .sidebar-heading { padding: 20px; color: white; font-weight: bold; border-bottom: 1px solid #444; }
        .list-group-item { background: transparent; color: #adb5bd; border: none; padding: 12px 20px; }
        .list-group-item:hover, .list-group-item.active { background: #343a40; color: white; }
        #page-content-wrapper { width: 100%; }
    </style>
</head>
<body>
    <div id="wrapper">
        @include('layouts.admin.sidebar')

        <div id="page-content-wrapper">
            @include('layouts.admin.navbar')

            <div class="container-fluid p-4">
                @yield('content')
            </div>

            @include('layouts.admin.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>