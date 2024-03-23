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
        Not Found | Capstone Project Hub
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

    <link rel="stylesheet" href="{{ asset("assets/vendor/css/pages/page-misc.css") }}">
    <script src="{{ asset("assets/vendor/js/helpers.js") }}"></script>
    <script src="{{ asset("assets/js/config.js") }}"></script>

</head>
<body>
    
    <div class="misc-wrapper">
        <h1 class="mb-2 mx-2" style="font-size: 6rem">404</h1>
        <h4 class="mb-2">Page Not Found ⚠️</h4>
        <p class="mb-4 mx-2">we couldn't find the page you are looking for</p>
        <div class="d-flex justify-content-center mt-5">
          <img
            src="{{ asset("assets/img/illustrations/misc-error-object.png") }}"
            alt="misc-error"
            class="img-fluid misc-object d-none d-lg-inline-block"
            width="160" />
          <img
            src="{{ asset("assets/img/illustrations/misc-bg-light.png") }}"
            alt="misc-error"
            class="misc-bg d-none d-lg-inline-block"
            data-app-light-img="illustrations/misc-bg-light.png"
            data-app-dark-img="illustrations/misc-bg-dark.png" />
          <div class="d-flex flex-column align-items-center">
            <img
              src="{{ asset("assets/img/illustrations/misc-error-illustration.png") }}"
              alt="misc-error"
              class="img-fluid zindex-1"
              width="190" />
            <div>
              <a href="{{ route("index") }}" class="btn btn-primary text-center my-4">Back to home</a>
            </div>
          </div>
        </div>
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