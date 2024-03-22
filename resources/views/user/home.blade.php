@extends("layouts.default")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Home Page
    @endif
@endsection

@section("links")
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-select/bootstrap-select.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/select2/select2.css") }}">
@endsection

@section("content")
    <div class="d-flex justify-content-end align-items-center">
        <div class="col-xl-3 col-lg-3 col-md-6 col-10 me-2">
            <div class="input-group input-group-merge">
                <span class="input-group-text" id="search-form"><i class="mdi mdi-magnify"></i></span>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Search..."
                  aria-label="Search..."
                  aria-describedby="search-form" />
            </div>
        </div>
        <div class="btn-group">
            <button
                type="button"
                class="btn btn-white border btn-icon dropdown-toggle hide-arrow"
                data-bs-toggle="dropdown"
                data-bs-auto-close="outside"
                aria-haspopup="true"
                aria-expanded="false"
            >
                <i class="mdi mdi-filter-cog"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end mt-2 w-px-250 p-3">
                <div class="mb-1">
                    <label class="form-label mb-1 text-dark">Year Published</label>
                    <select
                        class="select2 form-select"
                    >
                        <option value="All">All</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
                <div class="mb-1">
                    <label class="form-label mb-1 text-dark">Book Type</label>
                    <select
                        class="select2 form-select"
                    >
                        <option value="All">All</option>
                        <option value="Thesis">Thesis</option>
                        <option value="Capstone">Capstone</option>
                        <option value="Masteral">Masteral</option>
                        <option value="Doctoral">Doctoral</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button
                        type="button"
                        class="btn btn-sm btn-primary"
                    >
                        Apply
                    </button>
                    <button
                        type="button"
                        class="btn btn-sm btn-outline-secondary"
                    >
                        Reset
                    </button>
                </div>
            </ul>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        @forelse (getBooks() as $book)
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 cursor-pointer open-book" data-route="{{ route("student.book", $book->slug) }}">
                <div class="card-body text-center">
                    <img src="{{ asset("assets/img/icons/pdf-1.png") }}" height="100" alt="PDF Logo"/>
                    <h6 class="fw-bold text-primary my-3">
                        {{ $book->title }}
                    </h6>

                    <div class="mb-1">
                        @foreach ($book->typeArray() as $item)
                            <span class="badge bg-primary mb-1">{{ $item }}</span>
                        @endforeach
                    </div>
                    <small class="text-dark fw-bold">{{ $book->course->name }}</small>
                </div>
                <div class="card-footer pt-0 border-top">
                    <div class="d-flex justify-content-end align-items-center mt-2">
                        <small class="fw-bold text-dark me-2">Uploaded By: </small>
                        <div class="avatar avatar-xs me-1">
                            <img src="{{ $book->user->avatar() }}" class="rounded-circle" alt="Avatar"/>
                        </div>
                        <small class="text-dark">{{ $book->user->fullname }}</small>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-1">
                        <span class="me-2">
                            <i class="mdi mdi-star text-warning"></i>
                            {{ $book->average() }}
                        </span>
                        <span>
                            <i class="mdi mdi-download text-primary"></i>
                            {{ $book->downloads->count() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @empty
            
        @endforelse
    </div>
@endsection

@section("scripts")
    <script src="{{ asset("assets/vendor/libs/select2/select2.js") }}"></script>
    <script>
        $(document).ready(function() {
            $(".select2").each(function () {
                var $this = $(this);
                select2Focus($this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    minimumResultsForSearch: Infinity,
                    placeholder: 'Select value',
                    dropdownParent: $this.parent()
                });
            });

            $(document).on("click", ".open-book", function() {
                const route = $(this).data("route")

                window.location.assign(route);
            })
        });
    </script>
@endsection