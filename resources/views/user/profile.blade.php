@extends("layouts.default")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    My Profile
    @endif
@endsection

@section("links")
    <link rel="stylesheet" href="{{ asset("assets/vendor/css/pages/page-profile.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/select2/select2.css") }}">
    <style>
        .select2-selection__rendered .avatar img {
            margin-top: -19px;
        }
    </style>
@endsection

@section("content")
    <h4 class="py-3"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header-banner">
                    <img src="{{ asset("assets/img/pages/profile-banner.png") }}" alt="Banner image" class="rounded-top" />
                </div>
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img
                          src="{{ $user->avatar() }}"
                          alt="user image"
                          class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4"
                        >

                            <div class="user-profile-info">
                                <h4>{{ $user->fullname }}</h4>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item">
                                        <i class="mdi mdi-domain me-1 mdi-20px"></i
                                        ><span class="fw-medium"> {{ $user->college->name }}</span>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-4">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <div class="card">
                <div class="card-body">
                    <small class="card-text text-uppercase">About</small>
                    <ul class="list-unstyled my-1 py-1">
                        <li class="d-flex align-items-center">
                          <span class="fw-medium mx-2">Full Name:</span> <span>{{ $user->fullname }}</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="fw-medium mx-2">Username:</span> <span>{{ $user->username }}</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="fw-medium mx-2">Role:</span> <span>{{ $user->role->name }}</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="fw-medium mx-2">Year Level:</span> <span>{{ $user->year_level }}</span>
                        </li>
                        <li class="d-flex align-items-center">
                            <span class="fw-medium mx-2">Status:</span> <span class="text-{{ $user->accountColor() }}">{{ $user->accountText() }}</span>
                        </li>
                    </ul>

                    <div class="d-flex justify-content-between">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#general" class="btn btn-sm btn-primary me-2">Update Account</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#change" class="btn btn-sm btn-outline-primary">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-8 col-lg-7 col-md-7">
            <h5 class="card-title mb-3">My Books</h5>
            @forelse ($user->books as $item)
            <div class="col-12">
                <div class="card mb-4" >
                    <div class="card-body d-flex align-items-center pb-0">
                        <img src="{{ asset("assets/img/icons/pdf-1.png") }}" height="50" alt="PDF Logo" />
                        <div class="ms-2 w-100">
                            <small class="mb-2 d-block text-end">
                                <span class="fw-bold text-dark">Date Uploaded:</span> {{ $item->created_at->format("F d, Y") }}
                            </small>
                            <p class="mb-2 fw-bold text-primary">
                                <small>{{ $item->title }}</small>
                            </p>
                            <p class="mb-0 text-dark">
                                <small>{{ $item->course->name }}</small>
                            </p>
                            @foreach ($item->typeArray() as $type)
                                <span class="badge bg-primary mb-1">{{ $type }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end pt-2">
                        <a href="{{ route("student.my-books.edit", $item->slug) }}" class="me-2 btn btn-icon btn-label-warning">
                            <i class="mdi mdi-lead-pencil"></i>
                        </a>
                        <a href="{{ route("student.my-books.show", $item->slug) }}" class="btn btn-icon btn-label-primary">
                            <i class="mdi mdi-eye-arrow-right-outline"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <h6 class="text-center">No Books Available</h6>
            @endforelse
        </div>
    </div>

@include("user.modal.general")
@include("user.modal.password")
@endsection

@section("scripts")
    <script src="{{ asset("assets/vendor/libs/select2/select2.js") }}"></script>
    <script>
        $(".select2").each(function () {
            var $this = $(this);
            select2Focus($this);
            $this.wrap('<div class="position-relative"></div>').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Select value',
                dropdownParent: $this.parent()
            });
        });

        function renderIcons(option) {
            if (!option.id) {
            return option.text;
            }

            var $icon = "<div class='d-flex justify-content-start align-items-center'><div class='avatar avatar-sm me-1'><img src='"+ $(option.element).data('src') +"' class='rounded-circle' alt='Avatar' /></div>" + option.text + "</div>";

            return $icon;
        }
        $(".select2-avatar").each(function() {
            var $this = $(this);
            select2Focus($this);
            $this.wrap('<div class="position-relative"></div>').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Select avatar',
                dropdownParent: $this.parent(),
                templateResult: renderIcons,
                templateSelection: renderIcons,
                escapeMarkup: function (es) {
                    return es;
                }
            });
        });

        $("#general select[name=college]").val('{{ $user->college_id }}').trigger("change")
        $("#general select[name=year]").val('{{ $user->year_level }}').trigger("change")
        $("#general select[name=avatar]").val('{{ $user->avatar }}').trigger("change")
    </script>
@endsection