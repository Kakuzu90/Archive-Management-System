@extends("layouts.app")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Create Book
    @endif
@endsection

@section("links")
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-select/bootstrap-select.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/flatpickr/flatpickr.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/tagify/tagify.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/select2/select2.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/quill/typography.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/quill/katex.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/quill/editor.css") }}" />
    <style>
        .select2-selection__rendered .avatar img {
            margin-top: -19px;
        }
    </style>
@endsection

@section("content")
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Capstone /</span> Create Book</h4>

<div class="app-commerce">
    <form action="{{ route("admin.books.store") }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="d-flex justify-content-end align-items-center mb-4">
        <div class="d-flex align-content-center flex-wrap gap-3">
            <a href="{{ route("admin.books.index") }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Book</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-7">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Book Front</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="form-floating form-floating-outline mb-2">
                        <input
                          type="text"
                          class="form-control"
                          id="title"
                          placeholder="Book title"
                          name="title"
                          aria-label="Book title" />
                        <label for="title">Book Title</label>
                    </div>
                    <div>
                        <label class="form-label">Abstract</label>
                        <input type="hidden" name="abstract">
                        <div class="form-control p-0 pt-1 mb-3">
                            <div class="abstract-toolbar border-0 border-bottom">
                              <div class="d-flex justify-content-start">
                                <span class="ql-formats me-0">
                                  <button class="ql-bold"></button>
                                  <button class="ql-italic"></button>
                                  <button class="ql-underline"></button>
                                  <button class="ql-list" value="ordered"></button>
                                  <button class="ql-list" value="bullet"></button>
                                </span>
                              </div>
                            </div>
                            <div class="abstract-editor border-0 pb-1" id="abstract-editor"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Book File</h5>
                </div>
                <div class="card-body">
                    <div class="border border-dark border-dashed p-4 rounded text-center">
                        <div class="d-none mb-3 text-dark" id="upload_container">
                            <img src="{{ asset("assets/img/icons/pdf-1.png") }}" class="h-px-100" alt="PDF Icon" />
                            <p class="upload-name mb-0 mt-3"></p>
                            <p class="upload-size mb-3"></p>
                            <button
                                id="upload-remove"
                                type="button"
                                class="btn btn-sm btn-label-danger"
                            >
                                <i class="mdi mdi-attachment-remove me-1"></i>
                                Remove File
                            </button>
                        </div>
                        <label for="btn-upload" class="btn btn-outline-primary">
                            <span><i class="mdi mdi-attachment"></i> Browse File</span>
                            <input type="file" name="file" id="btn-upload" accept="application/pdf" hidden>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Researchers</h5>
                </div>
                <div class="card-body pt-0">

                    <div class="col-sm-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <select
                              class="form-select form-select-lg"
                              id="user"
                              name="user"
                              required
                            ></select>
                            <label for="user">Uploader Name</label>
                        </div>
                    </div>

                    <div class="col-sm-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <input 
                                type="text" id="author" name="authors" 
                                class="form-control h-auto tagify-authors" 
                                placeholder="Type the authors name here and press enter"
                                aria-label="Authors Tagify"
                                required />
                            <label for="author">Authors Name</label>
                        </div>
                    </div>

                    @superadmin
                    <div class="col-sm-12 mb-3">
                        <div class="form-floating form-floating-outline">
                          <select
                            class="select2 form-select form-select-lg"
                            id="college"
                            name="college"
                          >
                            @foreach (getColleges() as $item)
                              <option value="{{ $item->id }}">
                                {{ $item->name }}
                              </option>
                            @endforeach
                          </select>
                          <label for="college">College</label>
                        </div>
                    </div>
                    @endsuperadmin

                    <div class="col-sm-12 mb-3">
                        <div class="form-floating form-floating-outline">
                          <select
                            class="select2 form-select form-select-lg"
                            id="course"
                            name="course"
                            required
                          >
                            @foreach (getCourses() as $item)
                              <option value="{{ $item->id }}">
                                {{ $item->name }}
                              </option>
                            @endforeach
                          </select>
                          <label for="course">Program</label>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Other Info</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="col-sm-12 mb-3">
                        <div class="form-floating form-floating-outline">
                            <input 
                                type="text" id="book_type" name="book_type" 
                                class="form-control tagify-book-type" 
                                aria-label="Book Type Tagify"
                                required />
                            <label for="book_type">Book Type</label>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="text"
                            id="published"
                            name="published"
                            class="form-control flatpickr-human-friendly"
                            placeholder="Select a date" />
                          <label for="published">Year</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </form>
</div>

@endsection

@section("scripts")
    <script src="{{ asset("assets/vendor/libs/moment/moment.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/tagify/tagify.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/flatpickr/flatpickr.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/select2/select2.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/quill/katex.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/quill/quill.js") }}"></script>

    <script>
    $(document).ready(function() {

        const abstractEditor = document.querySelector('.abstract-editor');
        const tagifyBook = document.querySelector('.tagify-book-type');
        const tagifyAuthor = document.querySelector('.tagify-authors');

        $('.flatpickr-human-friendly').flatpickr({
            altInput: true,
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d'
        });

        if (abstractEditor) {
            new Quill(abstractEditor, {
                modules: {
                    toolbar: '.abstract-toolbar'
                },
                placeholder: 'Write here',
                theme: 'snow'
            });
        }

        document.querySelector('form').onsubmit = function() {
            const content = document.querySelector('.ql-editor').innerHTML;
            $("input[name=abstract]").val(content)
        };

        $(".select2").each(function () {
            var $this = $(this);
            select2Focus($this);
            $this.wrap('<div class="position-relative"></div>').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Select value',
                dropdownParent: $this.parent()
            });
        });

        $("#user").select2({
            ajax: {
                url: '{{ route('api.admin.search') }}',
                data: function(params) {
                    return {search : params.term}
                },
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: 'Search last name here...',
            minimumInputLength: 1,
            escapeMarkup: function (markup) {
                return markup;
            },
            templateResult: renderSelectionAvatar,
            templateSelection: renderAvatar
        })

        function renderAvatar(option) {
            if (!option.id) {
                return option.text;
            }

            var $icon = "<div class='d-flex justify-content-start align-items-center'><div class='avatar avatar-sm me-1'><img src='"+ option.avatar +"' class='rounded-circle' alt='Avatar' /></div>" + option.text + "</div>";

            return $icon;
        }

        function renderSelectionAvatar(option) {
            if (!option.id) {
                return option.text;
            }

            var $icon = "<div class='d-flex justify-content-start align-items-center'><div class='avatar avatar-sm me-1'><img src='"+ option.avatar +"' class='rounded-circle' alt='Avatar' /></div><div><p class='font-11 mb-0'>" + option.text + "</p><small class='badge bg-warning'>"+ option.role+"</small>" + "</div></div>";

            return $icon;
        }

        new Tagify(tagifyAuthor);
        new Tagify(tagifyBook, {
            whitelist: ["Thesis", "Capstone", "Master`s Thesis", "Dissertation"],
            maxTags: 5,
            dropdown: {
                maxItems: 10,
                classname: '',
                enabled: 0,
                closeOnSelect: false
            }
        });

        $(document).on("change", "#btn-upload", function(e) {
            const file = e.target.files;

            if (file) {
                const filename = file[0].name;
                const size = (file[0].size / 1024).toFixed(2);
                $("#upload_container").addClass("d-block");
                $("#upload_container").removeClass("d-none");
                $(".upload-name").text(filename);
                $(".upload-size").text(size + " KB"); 
            }
        });

        $(document).on("click", "#upload-remove", function() {
            $("input[name=file]").val(null);
            $("#upload_container").removeClass("d-block");
            $("#upload_container").addClass("d-none");
            $(".upload-name").text(null);
            $(".upload-size").text(null);
        });

    });
    </script>
@endsection