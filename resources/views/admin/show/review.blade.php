@extends("layouts.app")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Book Details
    @endif
@endsection

@section("links")
    <style>
        @media (max-width: 575.98px) {
            .widget-separator .border-shift.border-end {
                border-right: none !important;
                border-left: none !important;
            }
        }
    </style>
@endsection

@section("content")
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Capstone / Books /</span> {{ $book->title }}</h4>

<div class="row mb-4 g-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body row widget-separator">
                <div class="col-sm-5 border-shift border-end text-center">
                    <img src="{{ asset("assets/img/icons/pdf-1.png") }}" height="75" alt="PDF Avataar" />
                    <small class="d-block mt-2">Uploaded By</small>
                    <div class="d-flex justify-content-center align-items-center mb-2">
                        <div class="avatar avatar-sm me-1">
                            <img src="{{ $book->user->avatar() }}" class="rounded-circle" alt="User Avatar" />
                        </div>
                        <span class="fw-bold text-dark">{{ $book->user->fullname }}</span>
                    </div>
                    
                    @foreach ($book->typeArray() as $item)
                        <span class="badge bg-primary mb-1">{{ $item }}</span>
                    @endforeach

                    <hr class="d-sm-none" />
                </div>

                <div class="col-sm-7">
                    <div class="d-flex justify-content-end mb-2">
                        <span class="badge bg-{{ $book->statusColor() }}">
                            {{ $book->statusText() }}
                        </span>
                    </div>
                    <div class="mb-1 mt-4">
                        <span class="fw-bold text-dark">Authors Name: </span>
                        @foreach ($book->authorArray() as $item)
                            <span class="badge bg-primary mb-1">{{ $item }}</span>
                        @endforeach
                    </div>
                    <p class="mb-1">
                        <span class="fw-bold text-dark">College: </span>
                        <span class="text-dark">{{ $book->college->name }}</span>
                    </p>
                    <p class="mb-1">
                        <span class="fw-bold text-dark">Program: </span>
                        <span class="text-dark">{{ $book->course->name }}</span>
                    </p>
                    <p class="mb-1">
                        <span class="fw-bold text-dark">Date Published: </span>
                        <span class="text-dark">{{ $book->published_at->format("F d, Y") }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body row widget-separator">
                <div class="col-sm-5 border-shift border-end">
                    <div class="d-flex align-items-center mb-3">
                      <span class="text-primary display-5 fw-normal">{{ $book->average() }}</span>
                      <span class="mdi mdi-star mdi-24px ms-1 text-primary"></span>
                    </div>
                    <h6>Total {{ $book->reviews->count() }} {{ $book->reviews->count() > 1 ? 'reviews' : 'review' }}</h6>
                    <p>All reviews are from genuine researchers</p>
                    <span class="badge bg-label-primary rounded-pill p-2 mb-3 mb-sm-0">
                        <i class="mdi mdi-download"></i> {{ $book->downloads->count() }}
                    </span>
                    <hr class="d-sm-none" />
                </div>

                <div class="col-sm-7 g-2 text-nowrap d-flex flex-column justify-content-between px-4 gap-3">

                    @foreach ($book->getRatingPercentage() as $rate)
                    <div class="d-flex align-items-center gap-3">
                        <small>{{ $rate[0] }} Star</small>
                        <div class="progress w-100 rounded" style="height: 10px">
                          <div
                            class="progress-bar bg-primary"
                            role="progressbar"
                            style="width: {{ $rate[1] }}%"
                            aria-valuenow="{{ $rate[1] }}"
                            aria-valuemin="0"
                            aria-valuemax="100"></div>
                        </div>
                        <small class="w-px-20 text-end">{{ $rate[2] }}</small>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0 card-title">Researchers Feedback</h5>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <table class="datatable-init table">
            <thead>
                <tr>
                    <th class="text-start">Researcher Name</th>
                    <th class="text-center">College</th>
                    <th class="text-center">Comment</th>
                    <th class="text-center">Rate</th>
                    <th class="text-center">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($book->reviews as $item)
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
                            <span>{{ $item->user->college->name }}</span>
                        </td>
                        <td>
                            <span>{{ $item->comment }}</span>
                        </td>
                        <td>
                            <span class="badge bg-warning">{{ $item->rate }}</span>
                        </td>
                        <td>
                            <span>{{ $item->created_at->format("F d, Y") }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 card-title">List Who Downloaded</h5>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <table class="datatable-init1 table">
            <thead>
                <tr>
                    <th class="text-start">Researcher Name</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">College</th>
                    <th class="text-center">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($book->downloads as $item)
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
                            <span>{{ $item->user->college->name }}</span>
                        </td>
                        <td class="text-center">
                            <span>{{ $item->created_at->format("F d, Y") }}</span>
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
            order: [[4, "desc"]]
        });
        $(".datatable-init1").DataTable({
            order: [[3, "desc"]]
         });
    </script>
@endsection