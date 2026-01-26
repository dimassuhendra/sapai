<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SAPAI Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --student-primary: #4f46e5;
            /* Indigo Utama */
            --student-secondary: #7c3aed;
            /* Violet */
            --body-bg: #f8fafc;
        }

        body {
            font-family: 'Fredoka', sans-serif;
            background-color: var(--body-bg);
            overflow-x: hidden;
        }

        #wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        /* Content Area Adjustments */
        #content {
            width: 100%;
            min-height: 100vh;
            padding: 25px;
            margin-left: 280px;
            /* Sesuai lebar sidebar */
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        /* Responsif untuk Sidebar yang Fixed */
        @media (max-width: 768px) {
            #content {
                margin-left: 0;
                padding: 15px;
            }
        }

        /* Animasi Transisi Halaman */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    <div id="wrapper">
        @include('layouts.student.sidebar')

        <div id="content">
            @include('layouts.student.navbar')

            <main class="py-4 flex-grow-1 fade-in">
                @yield('content')
            </main>

            @include('layouts.student.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>