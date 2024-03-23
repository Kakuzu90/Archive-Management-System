@extends("layouts.default")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Book Details
    @endif
@endsection

@section("links")
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/quill/typography.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/rateyo/rateyo.css") }}">
@endsection

@section("content")
<a href="{{ changeRoute("student.home") }}">
    <i class="mdi mdi-arrow-left"></i> Go back
</a>

<div class="row g-4 mt-1">
    <div class="col-xl-8 col-lg-8 col-md-7 order-md-1 order-2">
        <div class="card">
            <div class="card-body text-dark">
                <h5 class="card-title">{{ $pdf->title }}</h5>
                <h5 class="card-title text-primary">Abstract</h5>
                {!! $pdf->abstract !!}
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-5 order-md-2 order-1">
        <div class="card">
            <div class="card-header pb-0">
                <a class="btn btn-sm btn-label-primary w-100" href="{{ route("api.book.download", $pdf->id) }}" target="_blank" download>
                    <i class="mdi mdi-file-download me-1"></i> Download Now
                </a>
            </div>
            <div class="card-body pb-3">
                <div class="mb-1">
                    <small class="text-dark fw-bold">Authors: </small>
                    @foreach ($pdf->authorArray() as $user)
                        <span class="badge bg-primary mb-1">{{ $user }}</span>
                    @endforeach
                </div>
                <div class="mb-1">
                    <small class="text-dark fw-bold">Book Type: </small>
                    @foreach ($pdf->typeArray() as $item)
                        <span class="badge bg-primary mb-1">{{ $item }}</span>
                    @endforeach
                </div>
                <p class="mb-1 text-dark">
                    <small class="text-dark fw-bold">Course: </small>
                    <small>{{ $pdf->course->name }}</small>
                </p>
                <p class="mb-0">
                    <small class="text-dark fw-bold">Date Published: </small>
                    <small class="text-dark">{{ $pdf->published_at->format("F d, Y") }}</small>
                </p>
            </div>
            <div class="card-footer pt-0 border-top">
                <div class="d-flex justify-content-start align-items-center mt-2">
                    <small class="fw-bold text-dark me-2">Uploaded By: </small>
                    <div class="avatar avatar-xs me-1">
                        <img src="{{ $pdf->user->avatar() }}" class="rounded-circle" alt="Avatar"/>
                    </div>
                    <small class="text-dark">{{ $pdf->user->fullname }}</small>
                </div>
                <div class="d-flex justify-content-start align-items-center mt-1">
                    <span class="me-2">
                        <i class="mdi mdi-star text-warning"></i>
                        {{ $pdf->average() }}
                    </span>
                    <span>
                        <i class="mdi mdi-download text-primary"></i>
                        {{ $pdf->downloads->count() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-10 col-12 mx-md-auto order-3">
        <div class="d-flex justify-content-end align-items-center mb-3">
            <button
                type="button"
                class="btn btn-sm btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#add"
            >
                <i class="mdi mdi-lead-pencil me-1"></i> Write a Review
            </button>
        </div>

        <div class="row gy-3" id="review-section">
            @foreach ($reviews as $item)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start">
                            <div class="avatar">
                                <img src="{{ $item->user->avatar() }}" class="rounded-circle" alt="Avatar" />
                            </div>
                            <div class="col ms-3">
                                <div class="read-only-ratings px-0 mb-1" data-value="{{ $item->rate }}" data-rateyo-read-only="true"></div>
                                <h6 class="text-dark fw-bold mb-1">{{ $item->user->fullname }}</h6>
                                <p class="mb-1 py-1 border-top border-bottom">{{ $item->comment }}</p>
                                <span class="text-dark">{{ $item->created_at->format("F d, Y") }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-12 d-flex justify-content-center d-none" id="spinner">
                <div class="spinner-border spinner-border-lg text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

        </div>

    </div>
</div>
@include("user.modal.review")
@endsection

@section("scripts")
    <script src="{{ asset("assets/vendor/libs/rateyo/rateyo.js") }}"></script>
    <script>
        $(document).ready(function() {
            let isLoading = false;
            let page = 2;

            async function loadMoreContent() {
                if (isLoading || !(await hasMoreContent(page))) {
                    return;
                }

                isLoading = true;
                showLoading();

                $.ajax({
                    url: '{{ route("api.book.reviews", $pdf->id) }}',
                    method: "GET",
                    data: { page: page },
                    success: function(response) {
                        response.data.forEach(function(content) {
                            $("#review-section").append(content);
                        })
                        $(".read-only-ratings").each(function() {
                            const rate = $(this).data("value")
                            $(this).rateYo({
                                rating: rate,
                                readOnly: true,
                                starWidth: "24px",
                                rtl: false,
                            });
                        })
                        hideLoading();
                        isLoading = false;
                        page++;
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading more content:', error);
                        isLoading = false;
                    }
                })
            }

            function showLoading() {
                $("#spinner").removeClass("d-none");
                $("#spinner").addClass("d-block");
            }

            function hideLoading() {
                $("#spinner").removeClass("d-block");
                $("#spinner").addClass("d-none");
            }

            async function hasMoreContent(page) {
                try {
                    const response = await $.ajax({
                        url: '{{ route("api.book.reviews", $pdf->id) }}',
                        method: "GET",
                        data: { page: page }
                    });

                    return response.hasMore;
                } catch (error) {
                    console.error('Error loading more content:', error);
                    return false; // Return false in case of error
                }
            }

            $(window).scroll(function() {
                var scrollTop = $(window).scrollTop();
                var documentHeight = $(document).height();
                var windowHeight = $(window).height();

                if (scrollTop + windowHeight >= documentHeight - 100) {
                    loadMoreContent();
                }
            });


            $(".read-only-ratings").each(function() {
                const rate = $(this).data("value")
                $(this).rateYo({
                    rating: rate,
                    readOnly: true,
                    starWidth: "24px",
                    rtl: false,
                });
            })

            $(".set-rateyo").rateYo({
                fullStar: true,
                onSet: function (rating, rateYoInstance) {
                    $("#add input[name=rate]").val(rating)
                }
            });
        });
    </script>
@endsection