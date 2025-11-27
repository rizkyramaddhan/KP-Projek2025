<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/style.css', 'resources/js/script.js'])
</head>

<body>

    <div class="container">
        <div class="sidebar">
            <header class="header">
                <a href="">
                    <img src="{{ asset('build/assets/img/static/icon-header.svg') }}" width="22.83px" height="16px"
                        alt="" class="icon-header">
                    <span class="description-header">Command Center</span>
                </a>
            </header>

            <div class="main">
                <div class="list-item">
                    <a href="">
                        <img src="{{ asset('build/assets/img/static/main-header.png') }}" width="154px" height="97"
                            alt="" class="icon">
                        <span class="description"></span>
                    </a>

                    <ul>
                        <li>
                            <img src="{{ asset('build/assets/img/sidebar/dashboard.svg') }}" alt="">
                            <span>Dashboard</span>
                        </li>
                        <li>
                            <img src="{{ asset('build/assets/img/sidebar/analytic.svg') }}" alt="">
                            <span>Analytics</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-content">

        </div>
    </div>

</body>

</html>
