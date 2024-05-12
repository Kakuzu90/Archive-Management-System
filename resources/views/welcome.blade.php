<!DOCTYPE html>
<html 
    lang="en"
    class="light-style layout-navbar-fixed customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="assets/"
    data-template="front-pages"
    >
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Welcome to Digital Capstone Project Hub
    </title>
    <link rel="shortcut icon" href="{{ asset("favicon.png") }}" type="image/x-icon">
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset("assets/vendor/fonts/materialdesignicons.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/fonts/flag-icons.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/node-waves/node-waves.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/css/rtl/core.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/css/theme-default.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/demo.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/typeahead-js/typeahead.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/quill/typography.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/css/welcome.css") }}">
    <script src="{{ asset("assets/vendor/js/helpers.js") }}"></script>
    <script src="{{ asset("assets/js/config.js") }}"></script>

</head>
<body class="bg-white">
    
    <nav class="layout-navbar container shadow-none py-0">
        <div class="navbar navbar-expand-lg landing-navbar border-top-0 px-3 px-md-4">
            <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">

                <a href="{{ route("index") }}" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <a href="{{ route("index") }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset("favicon.png") }}" width="35" height="35" alt="Brand Logo" />
                            </span>
                            <span class="app-brand-text menu-text fw-bold ms-1 ps-1 d-md-block d-none">
                                Digital Capstone Project Hub
                            </span>
                        </a>
                    </span>
                </a>
            </div>

            <div class="landing-menu-overlay d-lg-none"></div>

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item">
                    <a class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4" href="{{ route("login") }}">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="library-background d-flex align-items-center justify-content-center flex-column">
        <h1 class="fw-bold" style="font-family: serif;">Digital Capstone Project Hub</h1>
        <div class="col-md-6 col-11 mx-auto text-center">
            <h6 class="text-white mb-0">Register As</h6>
            <div class="demo-inline-spacing">
                <a href="{{ route("register.student") }}" class="btn rounded-pill btn-primary">Student</a>
                <a href="{{ route("register.faculty") }}" class="btn rounded-pill btn-secondary">Faculty</a>
            </div>
        </div>
        <div class="overlay-library"></div>
    </div>

    

    <script src="{{ asset("assets/vendor/libs/jquery/jquery.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/popper/popper.js") }}"></script>
    <script src="{{ asset("assets/vendor/js/bootstrap.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/node-waves/node-waves.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/hammer/hammer.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/typeahead-js/typeahead.js") }}"></script>
    <script src="{{ asset("assets/vendor/js/menu.js") }}"></script>
    <script src="{{ asset("assets/js/main.js") }}"></script>

</body>
</html>