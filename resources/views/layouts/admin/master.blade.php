<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400;600;700&family=Fredoka:wght@300..700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --font-heading: 'Fredoka', sans-serif;
            --font-body: 'Domine', serif;
            --primary-color: #2193b0;
        }

        body {
            background-color: #f8f9fa;
            font-family: var(--font-body);
            color: #2d3436;
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .sidebar-heading,
        .btn,
        .nav-link {
            font-family: var(--font-heading);
            letter-spacing: 0.5px;
        }

        #wrapper {
            display: flex;
            align-items: stretch;
            min-height: 100vh;
            width: 100%;
        }

        #page-content-wrapper {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            /* Mengatur susunan secara vertikal */
            min-height: 100vh;
            /* Memastikan tinggi minimal adalah satu layar penuh */
        }

        main.container-fluid {
            flex-grow: 1;
            /* Ini kuncinya! Konten utama akan 'memakan' ruang kosong yang ada */
        }

        p {
            line-height: 1.8;
            margin-bottom: 1.2rem;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* Sidebar Responsive Logic */
        #sidebar-wrapper {
            width: 250px;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            #sidebar-wrapper {
                margin-left: -250px;
                position: fixed;
                height: 100%;
                z-index: 1100;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0;
            }
        }

        @media (min-width: 769px) {
            #wrapper.toggled #sidebar-wrapper {
                margin-left: -250px;
            }
        }
    </style>
</head>

<body>
    <div id="wrapper">
        @include('layouts.admin.sidebar')

        <div id="page-content-wrapper">
            @include('layouts.admin.navbar')

            <main class="container-fluid p-4">
                @yield('content')
            </main>

            @include('layouts.admin.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // 1. Sidebar Toggle
            const menuToggle = document.getElementById("menu-toggle");
            const wrapper = document.getElementById("wrapper");
            if (menuToggle) {
                menuToggle.onclick = function(e) {
                    e.preventDefault();
                    wrapper.classList.toggle("toggled");
                };
            }

            // 2. Force Dropdown Initialization
            // Jika atribut data-bs-toggle masih gagal, script ini akan memaksanya berjalan
            var dropdownElementList = [].slice.call(document.querySelectorAll('[data-bs-toggle="dropdown"]'))
            var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl)
            });
        });
    </script>
</body>

</html>