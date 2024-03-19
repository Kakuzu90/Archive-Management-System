@extends("layouts.app")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Faculty
    @endif
@endsection

@section("links")
    
@endsection

@section("content")
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Clients /</span> Faculty</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0 card-title">Faculty</h4>
        <button
            type="button"
            class="btn btn-sm btn-primary"
            data-bs-toggle="modal" data-bs-target="#add"
        >
            <i class="mdi mdi-plus-circle me-1"></i> New Faculty
        </button>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <table class="datatable-init table">
            <thead>
                <tr>
                    <th class="text-start">Faculty Name</th>
                    <th class="text-center">College</th>
                    <th class="text-center">Books</th>
                    <th class="text-center">Account Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faculties as $item)
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
                            <span class="badge bg-secondary">{{ $item->books->count() }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $item->accountColor() }}">
                                {{ $item->accountText() }}
                            </span>
                        </td>
                        <td class="text-center">

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