<!DOCTYPE html>
<html 
    lang="en"
    class="light-style layout-wide customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="assets/"
    data-template="vertical-menu-template-no-customizer"
    >
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield("title") | Capstone Project Hub
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

    <link rel="stylesheet" href="{{ asset("assets/vendor/css/pages/page-auth.css") }}">
    <script src="{{ asset("assets/vendor/js/helpers.js") }}"></script>
    <script src="{{ asset("assets/js/config.js") }}"></script>
    @yield("links")
</head>
<body>
    
    @yield("content")

    <script src="{{ asset("assets/vendor/libs/jquery/jquery.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/popper/popper.js") }}"></script>
    <script src="{{ asset("assets/vendor/js/bootstrap.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/node-waves/node-waves.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/hammer/hammer.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/typeahead-js/typeahead.js") }}"></script>
    <script src="{{ asset("assets/vendor/js/menu.js") }}"></script>
    <script src="{{ asset("assets/js/main.js") }}"></script>

    @yield("scripts")
</body>
</html>