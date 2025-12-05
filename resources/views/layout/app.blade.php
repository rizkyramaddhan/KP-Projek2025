<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Kp Project' }}</title>
    @vite(['resources/css/app.css', 'resources/css/style.css', 'resources/js/app.js'])
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet" /> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="../../css/tipe2.css" />
</head>

<body>
    @include('layout.body.header')

    @include('layout.body.sidebar')

    @yield('content')

    @include('layout.body.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar - Works on all devices
        const menuToggle = document.getElementById("menuToggle");
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("mainContent");
        const footer = document.getElementById("footer");

        menuToggle.addEventListener("click", function(e) {
            e.stopPropagation();
            sidebar.classList.toggle("collapsed");
            mainContent.classList.toggle("expanded");
            footer.classList.toggle("expanded");
        });

        // Close sidebar when clicking outside (optional - for better UX)
        document.addEventListener("click", function(event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnToggle = menuToggle.contains(event.target);
            const isSidebarCollapsed = sidebar.classList.contains("collapsed");

            // Only auto-close on mobile screens
            if (
                !isClickInsideSidebar &&
                !isClickOnToggle &&
                !isSidebarCollapsed &&
                window.innerWidth <= 768
            ) {
                sidebar.classList.add("collapsed");
                mainContent.classList.add("expanded");
                footer.classList.add("expanded");
            }
        });

        // Active menu highlight
        const menuLinks = document.querySelectorAll(".sidebar-menu a");
        menuLinks.forEach((link) => {
            link.addEventListener("click", function(e) {
                menuLinks.forEach((l) => l.classList.remove("active"));
                this.classList.add("active");
            });
        });
    </script>

</body>

</html>
