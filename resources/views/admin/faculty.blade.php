@extends("layouts.app")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Faculty
    @endif
@endsection

@section("links")
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-select/bootstrap-select.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/select2/select2.css") }}">
    <style>
        .select2-selection__rendered .avatar img {
            margin-top: -19px;
        }
    </style>
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
                        <td class="align-middle text-center">
                            <button
                                type="button"
                                class="edit btn btn-sm btn-icon btn-success"
                                data-route="{{ route("admin.faculty.show", $item->id) }}"
                            >
                                <i class="mdi mdi-pencil"></i>
                            </button>
                            <button
                                type="button"
                                class="delete btn btn-sm btn-icon btn-danger"
                                data-route="{{ route("admin.faculty.show", $item->id) }}"
                                data-title="{{ $item->fullname }}"
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

@include("admin.modal.faculty.add")
@include("admin.modal.faculty.edit")
@include("admin.modal.delete")
@endsection

@section("scripts")
    <script src="{{ asset("assets/vendor/libs/select2/select2.js") }}"></script>
    <script>
        $(".datatable-init").DataTable();
        const select2 = $(".select2");
        const select2Avatars = $(".select2-avatar")
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
        if (select2Avatars.length) {
            function renderIcons(option) {
                if (!option.id) {
                return option.text;
                }

                var $icon = "<div class='d-flex justify-content-start align-items-center'><div class='avatar avatar-sm me-1'><img src='"+ $(option.element).data('src') +"' class='rounded-circle' alt='Avatar' /></div>" + option.text + "</div>";

                return $icon;
            }
            select2Avatars.each(function() {
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

                    $("#edit input[name=first_name]").val(response.first_name)
                    $("#edit input[name=middle_name]").val(response.middle_name)
                    $("#edit input[name=last_name]").val(response.last_name)
                    $("#edit input[name=username]").val(response.username)
                    $("#edit select[name=college]").val(response.college_id).trigger("change")
                    $("#edit select[name=avatar]").val(response.avatar).trigger("change")

                    if (response.verified_at) {
                        $("#edit input[name=status]").prop("checked", true);
                    }
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