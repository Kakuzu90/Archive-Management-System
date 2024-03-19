@extends("layouts.app")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Books
    @endif
@endsection

@section("links")

@endsection

@section("content")
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Capstone /</span> Books</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0 card-title">Books</h4>
        <button
            type="button"
            class="btn btn-sm btn-primary"
            data-bs-toggle="modal" data-bs-target="#add"
        >
            <i class="mdi mdi-plus-circle me-1"></i> New Book
        </button>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <table class="datatable-init table">
            <thead>
                <tr>
                    <th class="text-start">Uploader Name</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">College</th>
                    <th class="text-center">Book Type</th>
                    <th class="text-center">Date Published</th>
                    <th class="text-center">Book Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $item)
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
                            @foreach ($item->typeArray() as $type)
                                <span class="badge bg-primary text-uppercase">
                                    {{ $type }}
                                </span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            <span>{{ $item->published_at->format("F d, Y") }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $item->statusColor() }}">
                                {{ $item->statusText() }}
                            </span>
                        </td>
                        <td class="text-center align-middle">
                            <div class="btn-group dropstart">
                                <button
                                    type="button"
                                    class="btn btn-light btn-icon rounded-pill dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route("admin.books.review", $item->id) }}">
                                            <i class="mdi mdi-eye-plus"></i> View Details
                                        </a>
                                    </li>
                                    <li>
                                        <a class="edit dropdown-item" href="javascript:void(0);">
                                            <i class="mdi mdi-download"></i> Download
                                        </a>
                                    </li>
                                    <li>
                                        <a class="edit dropdown-item" href="javascript:void(0);">
                                            <i class="mdi mdi-pencil"></i> Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="delete dropdown-item" href="javascript:void(0);">
                                            <i class="mdi mdi-delete-empty"></i> Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include("admin.modal.delete")
@endsection

@section("scripts")
    <script>
        $(".datatable-init").DataTable();
    </script>
@endsection