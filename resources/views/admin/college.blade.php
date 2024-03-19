@extends("layouts.app")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Colleges
    @endif
@endsection

@section("links")
    
@endsection

@section("content")
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Informations /</span> Colleges</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0 card-title">Colleges</h4>
        <button
            type="button"
            class="btn btn-sm btn-primary"
            data-bs-toggle="modal" data-bs-target="#add"
        >
            <i class="mdi mdi-plus-circle me-1"></i> New College
        </button>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <table class="datatable-init table">
            <thead>
                <tr>
                    <th class="text-start">College Name</th>
                    <th class="text-center">Courses</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($colleges as $item)
                    <tr>
                        <td class="text-start">
                            <span>{{ $item->name }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-info">{{ $item->courses->count() }}</span>
                        </td>
                        <td class="align-middle text-center">
                            <button
                                type="button"
                                class="edit btn btn-sm btn-icon btn-success"
                                data-route="{{ route("admin.colleges.show", $item->id) }}"
                            >
                                <i class="mdi mdi-pencil"></i>
                            </button>
                            <button
                                type="button"
                                class="delete btn btn-sm btn-icon btn-danger"
                                data-route="{{ route("admin.colleges.show", $item->id) }}"
                                data-title="{{ $item->name }}"
                            >
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include("admin.modal.college.add")
@include("admin.modal.college.edit")
@include("admin.modal.delete")
@endsection

@section("scripts")
    <script>
        $(".datatable-init").DataTable({
            order:[[0, "asc"]]
        });

        $(document).on("click", ".edit", function() {
            const route = $(this).data("route")
            
            $("#edit").modal("show")
            $("#edit #form_loader").removeClass("d-none")
            $("#edit #form_loader").addClass("d-block")
            $("#edit #form_container").removeClass("d-block")
            $("#edit #form_container").addClass("d-none")

            $.ajax({
                url: route,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    $("#edit #form_loader").addClass("d-none")
                    $("#edit #form_loader").removeClass("d-block")
                    $("#edit #form_container").addClass("d-block")
                    $("#edit #form_container").removeClass("d-none")
                    $("#edit form").attr("action", route)

                    $("#edit input[name=name]").val(response.name)
                }
            })
        })

        $(document).on("click", ".delete", function() {
            const route = $(this).data("route")
            const title = $(this).data("title")

            $("#delete .delete_data").text(title)
            $("#delete form").attr("action", route)
            $("#delete").modal("show")
        })
    </script>
@endsection