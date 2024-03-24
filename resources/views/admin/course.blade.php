@extends("layouts.app")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Programs
    @endif
@endsection

@section("links")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-select/bootstrap-select.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/select2/select2.css") }}">
@endsection

@section("content")
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Informations /</span> Programs</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0 card-title">Programs</h4>
        <button
            type="button"
            class="btn btn-sm btn-primary"
            data-bs-toggle="modal" data-bs-target="#add"
        >
            <i class="mdi mdi-plus-circle me-1"></i> New Program
        </button>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <table class="datatable-init table">
            <thead>
                <tr>
                    <th class="text-start">Program Name</th>
                    <th class="text-center">College</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $item)
                    <tr>
                        <td class="text-start">
                            <span>{{ $item->name }}</span>
                        </td>
                        <td class="text-center">
                            <span class="">{{ $item->college->name }}</span>
                        </td>
                        <td class="align-middle text-center">
                            <button
                                type="button"
                                class="edit btn btn-sm btn-icon btn-success"
                                data-route="{{ route("admin.programs.show", $item->id) }}"
                            >
                                <i class="mdi mdi-pencil"></i>
                            </button>
                            <button
                                type="button"
                                class="delete btn btn-sm btn-icon btn-danger"
                                data-route="{{ route("admin.programs.show", $item->id) }}"
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

@include("admin.modal.course.add")
@include("admin.modal.course.edit")
@include("admin.modal.delete")
@endsection

@section("scripts")
    <script src="{{ asset("assets/vendor/libs/select2/select2.js") }}"></script>
    <script>
        $(".datatable-init").DataTable({
            order: [[1, "asc"], [0, "asc"]]
        });
        const select2 = $(".select2");
        if (select2.length) {
            select2.each(function () {
                var $this = $(this);
                select2Focus($this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    minimumResultsForSearch: Infinity,
                    placeholder: 'Select value',
                    dropdownParent: $this.parent()
                });
            });
        }

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
                    $("#edit select[name=college]").val(response.college_id).trigger("change")
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