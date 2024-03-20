@extends("layouts.app")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Dashboard
    @endif
@endsection

@section("links")
    <link rel="stylesheet" href="{{ asset("assets/vendor/css/pages/cards-statistics.css") }}">
@endsection

@section("content")
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Home /</span> Dashboard</h4>

<div class="row gy-4 justify-content-center">
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <x-widget title="Book Accepted" icon="mdi-book-check" color="success" :count="$data['accepted']" />
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <x-widget title="Book Pending" icon="mdi-book-clock" color="warning" :count="$data['pending']" />
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <x-widget title="Book Rejected" icon="mdi-book-cancel" color="danger" :count="$data['rejected']" />
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <x-widget title="Total Students" icon="mdi-account-tie" color="primary" :count="$data['student']" />
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <x-widget title="Total Faculty" icon="mdi-account-tie-hat" color="info" :count="$data['faculty']" />
    </div>
    @superadmin
    <div class="col-xl-3 col-lg-4 col-sm-6">
        <x-widget title="Total Admin" icon="mdi-account-cowboy-hat" color="secondary" :count="$data['admin']" />
    </div>
    @endsuperadmin
</div>

<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title mb-0">List of Users to Verify</h4>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <table class="datatable-init table">
            <thead>
                <tr>
                    <th class="text-start">Name</th>
                    <th class="text-center">College</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Account Created</th>
                    <th class="text-center">Account Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($table["users"] as $item)
                    <tr>
                        <td class="text-start">
                            <div class="d-flex justify-content-start align-items-center">
                                <div class="avatar">
                                    <img src="{{ $item->avatar() }}" alt class="w-px-40 h-auto rounded-circle" />
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-0">{{ $item->fullname }}</h6>
                                    <small>{{ $item->username }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <span>{{ $item->college->name }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $item->roleColor() }}">{{ $item->role->name }}</span>
                        </td>
                        <td class="text-center">
                            <span>{{ $item->created_at->format("F d, Y") }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $item->accountColor() }}">{{ $item->accountText() }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ smartRoute($item) }}" class="nav-item nav-link">
                                <i class="mdi mdi-eye-plus"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title mb-0">Pending Books</h4>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <table class="datatable-init table">
            <thead>
                <tr>
                    <th class="text-start">Uploader Name</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">College</th>
                    <th class="text-center">Date Published</th>
                    <th class="text-center">Date Submitted</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($table["pending"] as $item)
                    <tr>
                        <td class="text-start">
                            <div class="d-flex justify-content-start align-items-center">
                                <div class="avatar">
                                    <img src="{{ $item->user->avatar() }}" alt class="w-px-40 h-auto rounded-circle" />
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-0">{{ $item->user->fullname }}</h6>
                                    <small>{{ $item->user->username }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <small>{{ $item->title }}</small>
                        </td>
                        <td class="text-center">
                            <span>{{ $item->college->name }}</span>
                        </td>
                        <td class="text-center">
                            <span class="fw-bold text-primary">{{ $item->published_at?->format("F d, Y") }}</span>
                        </td>
                        <td class="text-center">
                            <span class="fw-bold text-primary">{{ $item->created_at->format("F d, Y") }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route("admin.books.review", $item->id) }}" class="nav-item nav-link">
                                <i class="mdi mdi-eye-plus"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section("scripts")
    <script>
        $(".datatable-init").DataTable();
    </script>
@endsection