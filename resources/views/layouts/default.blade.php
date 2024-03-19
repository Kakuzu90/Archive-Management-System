<!DOCTYPE html>
<html 
    lang="en"
    class="light-style layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="assets/"
    data-template="horizontal-menu-template-no-customizer"
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

    <script src="{{ asset("assets/vendor/js/helpers.js") }}"></script>
    <script src="{{ asset("assets/js/config.js") }}"></script>
    @yield("links")
</head>
<body>
    
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
                <div class="container-xxl">
                    <div class="navbar-brand app-brand demo py-0 me-4">
                      <a href="{{ route("student.home") }}" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset("favicon.png") }}" width="35" height="35" alt="Brand Logo" />
                        </span>
                        <span class="app-brand-text demo text-heading fw-bold">Archive</span>
                      </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                  <div class="avatar avatar-online">
                                    <img src="{{ auth()->user()->avatar() }}" alt class="w-px-40 h-auto rounded-circle" />
                                  </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                  <li>
                                    <a class="dropdown-item" href="pages-account-settings-account.html">
                                      <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                          <div class="avatar avatar-online">
                                            <img src="{{ auth()->user()->avatar() }}" alt class="w-px-40 h-auto rounded-circle" />
                                          </div>
                                        </div>
                                        <div class="flex-grow-1">
                                          <span class="fw-medium d-block">{{ auth()->user()->fullname }}</span>
                                          <small class="text-primary">{{ auth()->user()->role->name }}</small>
                                        </div>
                                      </div>
                                    </a>
                                  </li>
                                  <li>
                                    <div class="dropdown-divider"></div>
                                  </li>
                                  <li>
                                    <a class="dropdown-item" href="pages-profile-user.html">
                                      <i class="mdi mdi-account-outline me-2"></i>
                                      <span class="align-middle">My Profile</span>
                                    </a>
                                  </li>
                                  <li>
                                    <div class="dropdown-divider"></div>
                                  </li>
                                  <li>
                                    <a class="dropdown-item" href="{{ route("student.logout") }}" target="_blank">
                                      <i class="mdi mdi-logout me-2"></i>
                                      <span class="align-middle">Log Out</span>
                                    </a>
                                  </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="layout-page">
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield("content")
                    </div>

                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                          <div
                            class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                              ©
                              <script>
                                document.write(new Date().getFullYear());
                              </script>
                              , Archive Management System
                            </div>
                            <div class="d-none d-lg-inline-block">
                              <a
                                href="https://www.facebook.com/clyde.arellano.31"
                                target="_blank"
                                class="footer-link me-4"
                                >Developer</a
                              >
                            </div>
                          </div>
                        </div>
                    </footer>

                    <div class="content-backdrop fade"></div>
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

    @yield("scripts")
</body>
</html>