@extends("layouts.app")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Activity Logs
    @endif
@endsection

@section("links")
    
@endsection

@section("content")
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Users /</span> Activity Logs</h4>

<div class="card">
    <div class="card-header">
        <h4 class="mb-0 card-title">Activity Logs</h4>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <table class="datatable-init table">
            <thead>
                <tr>
                    <th class="text-start">Name</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Context</th>
                    <th class="text-center">IP Address</th>
                    <th class="text-center">Type</th>
                    <th class="text-center">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $item)
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
                            <span class="badge bg-{{ $item->user->roleColor() }}">{{ $item->user->role->name }}</span>
                        </td>
                        <td class="text-center">
                            <small>{{ $item->context }}</small>
                        </td>
                        <td class="text-center">
                            <span class="text-primary">{{ $item->ip_address }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-{{ $item->typeColor() }}">
                                {{ $item->typeText() }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="text-primary">
                                {{ $item->created_at->format("F d, Y") }}
                            </span>
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
        $(".datatable-init").DataTable({
            order: [[5, "desc"], [0, "asc"]]
        });
    </script>
@endsection