<!DOCTYPE html>
<html 
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
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

    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/node-waves/node-waves.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/css/rtl/core.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/css/theme-default.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/demo.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/animate-css/animate.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/spinkit/spinkit.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/toastr/toastr.css") }}">

    <script src="{{ asset("assets/vendor/js/helpers.js") }}"></script>
    <script src="{{ asset("assets/js/config.js") }}"></script>
    @yield("links")
</head>
<body>
    
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ route("index") }}" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                          <img src="{{ asset("favicon.png") }}" width="35" height="35" alt="Brand Logo" />
                        </span>
                        <span class="app-brand-text demo text-heading fw-bold">Archive</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M11.4854 4.88844C11.0081 4.41121 10.2344 4.41121 9.75715 4.88844L4.51028 10.1353C4.03297 10.6126 4.03297 11.3865 4.51028 11.8638L9.75715 17.1107C10.2344 17.5879 11.0081 17.5879 11.4854 17.1107C11.9626 16.6334 11.9626 15.8597 11.4854 15.3824L7.96672 11.8638C7.48942 11.3865 7.48942 10.6126 7.96672 10.1353L11.4854 6.61667C11.9626 6.13943 11.9626 5.36568 11.4854 4.88844Z"
                            fill="currentColor"
                            fill-opacity="0.6" />
                          <path
                            d="M15.8683 4.88844L10.6214 10.1353C10.1441 10.6126 10.1441 11.3865 10.6214 11.8638L15.8683 17.1107C16.3455 17.5879 17.1192 17.5879 17.5965 17.1107C18.0737 16.6334 18.0737 15.8597 17.5965 15.3824L14.0778 11.8638C13.6005 11.3865 13.6005 10.6126 14.0778 10.1353L17.5965 6.61667C18.0737 6.13943 18.0737 5.36568 17.5965 4.88844C17.1192 4.41121 16.3455 4.41121 15.8683 4.88844Z"
                            fill="currentColor"
                            fill-opacity="0.38" />
                        </svg>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">

                    <li class="menu-header fw-medium mt-4">
                      <span class="menu-header-text">Home</span>
                    </li>

                    <li class="menu-item {{ isActive("admin.dashboard") ? 'active' : null }}">
                      <a href="{{ route("admin.dashboard") }}" class="menu-link">
                        <i class="menu-icon tf-icons mdi mdi-monitor-dashboard"></i>
                        <div>Dashboard</div>
                      </a>
                    </li>
                  
                  @superadmin
                  <li class="menu-header fw-medium mt-4">
                    <span class="menu-header-text">Informations</span>
                  </li>

                  <li class="menu-item {{ isActive("admin.colleges.index") ? 'active' : null }}">
                      <a href="{{ route("admin.colleges.index") }}" class="menu-link">
                        <i class="menu-icon tf-icons mdi mdi-domain"></i>
                        <div>Colleges</div>
                      </a>
                  </li>

                  <li class="menu-item {{ isActive("admin.programs.index") ? 'active' : null }}">
                      <a href="{{ route("admin.programs.index") }}" class="menu-link">
                        <i class="menu-icon tf-icons mdi mdi-tie"></i>
                        <div>Programs</div>
                      </a>
                  </li>
                  @endsuperadmin
                  
                    <li class="menu-header fw-medium mt-4">
                      <span class="menu-header-text">Capstone</span>
                    </li>

                    <li class="menu-item {{ isActive("admin.books.index|admin.books.review|admin.books.create|admin.books.edit") ? 'active' : null }}">
                        <a href="{{ route("admin.books.index") }}" class="menu-link">
                          <i class="menu-icon tf-icons mdi mdi-book-account"></i>
                          <div>Books</div>
													@if (bookPending() > 0)
													<div class="badge bg-danger rounded-pill ms-auto">{{ bookPending() }}</div>
													@endif
                        </a>
                    </li>

                    <li class="menu-header fw-medium mt-4">
                      <span class="menu-header-text">Users</span>
                    </li>

                    @superadmin
                    <li class="menu-item {{ isActive("admin.admins.index") ? 'active' : null }}">
                      <a href="{{ route("admin.admins.index") }}" class="menu-link">
                        <i class="menu-icon tf-icons mdi mdi-account-cowboy-hat"></i>
                        <div>Admins</div>
                      </a>
                    </li>
                    @endsuperadmin   

                    <li class="menu-item {{ isActive("admin.faculty.index") ? 'active' : null }}">
                        <a href="{{ route("admin.faculty.index") }}" class="menu-link">
                          <i class="menu-icon tf-icons mdi mdi-account-tie-hat"></i>
                          <div>Faculty</div>
													@if (facultyNotVerify() > 0)
													<div class="badge bg-danger rounded-pill ms-auto">{{ facultyNotVerify() }}</div>
													@endif
                        </a>
                    </li>

                    <li class="menu-item {{ isActive("admin.students.index") ? 'active' : null }}">
                        <a href="{{ route("admin.students.index") }}" class="menu-link">
                          <i class="menu-icon tf-icons mdi mdi-account-tie"></i>
                          <div>Students</div>
													@if (studentNotVerify() > 0)
													<div class="badge bg-danger rounded-pill ms-auto">{{ studentNotVerify() }}</div>
													@endif
                        </a>
                    </li>

                    <li class="menu-item {{ isActive("admin.activity.index") ? 'active' : null }}">
                      <a href="{{ route("admin.activity.index") }}" class="menu-link">
                        <i class="menu-icon tf-icons mdi mdi-chart-timeline-variant-shimmer"></i>
                        <div>Activity Logs</div>
                      </a>
                  </li>

                </ul>
            </aside>

            <div class="layout-page">
                <nav
                    class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar"
                >
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="mdi mdi-menu mdi-24px"></i>
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
                                <a class="dropdown-item" href="#">
                                  <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                      <div class="avatar avatar-online">
                                        <img src="{{ auth()->user()->avatar() }}" alt class="w-px-40 h-auto rounded-circle" />
                                      </div>
                                    </div>
                                    <div class="flex-grow-1">
                                      <span class="fw-medium d-block">{{ auth()->user()->fullname }}</span>
                                      <small class="text-danger">{{ auth()->user()->role->name }}</small>
                                    </div>
                                  </div>
                                </a>
                              </li>
                              <li>
                                <div class="dropdown-divider"></div>
                              </li>

                              <li>
                                <a class="dropdown-item" href="{{ route("admin.profile.index") }}">
                                  <i class="mdi mdi-account-outline me-2"></i>
                                  <span class="align-middle">My Profile</span>
                                </a>
                              </li>

                              <li>
                                <a class="dropdown-item" href="{{ route("admin.profile.logs") }}">
                                  <i class="mdi mdi-chart-timeline-variant me-2"></i>
                                  <span class="align-middle">Activity Log</span>
                                </a>
                              </li>

                              @superadmin
                              <li>
                                <a class="dropdown-item" href="{{ route("admin.settings.index") }}">
                                  <i class="mdi mdi-cog-outline me-2"></i>
                                  <span class="align-middle">Settings</span>
                                </a>
                              </li>
                              @endsuperadmin
                              
                              <li>
                                <div class="dropdown-divider"></div>
                              </li>
                              <li>
                                <a class="dropdown-item" href="{{ route("admin.logout") }}">
                                  <i class="mdi mdi-power me-2"></i>
                                  <span class="align-middle">Log Out</span>
                                </a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                    </div>
                </nav>

                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        @yield("content")
                    </div>

                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-fluid">
                          <div
                            class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                              ©
                              <script>
                                document.write(new Date().getFullYear());
                              </script>
                              , Archive Management System, Alright Reserved.
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
        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
    </div>

    <script src="{{ asset("assets/vendor/libs/jquery/jquery.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/popper/popper.js") }}"></script>
    <script src="{{ asset("assets/vendor/js/bootstrap.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/node-waves/node-waves.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/hammer/hammer.js") }}"></script>
    <script src="{{ asset("assets/vendor/js/menu.js") }}"></script>

    <script src="{{ asset("assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/toastr/toastr.js") }}"></script>
    @include("toastr")
    @yield("scripts")

    <script src="{{ asset("assets/js/main.js") }}"></script>
</body>
</html>