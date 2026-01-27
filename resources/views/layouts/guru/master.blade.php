<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Guru SAPAI</title>
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400;600;700&family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary-color: #4f46e5;
            --sidebar-width: 260px;
        }

        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: #fff;
            border-right: 1px solid #eef0f2;
            transition: all 0.3s;
        }

        /* Pastikan pembungkus konten di samping sidebar seperti ini */
        .main-content {
            margin-left: 280px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* Memaksa tinggi minimal selayar penuh */
        }

        .nav-link {
            color: #64748b;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 4px 15px;
        }

        .nav-link.active {
            background: var(--primary-color);
            color: #fff;
        }

        .nav-link:hover:not(.active) {
            background: #f1f5f9;
        }
    </style>
</head>

<body>
    @include('layouts.guru.sidebar')
    <div class="main-content">
        @include('layouts.guru.navbar')
        <div class="mt-4">@yield('content')</div>
        @include('layouts.guru.footer')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>