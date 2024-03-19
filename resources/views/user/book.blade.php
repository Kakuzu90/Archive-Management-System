@extends("layouts.default")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Book Details
    @endif
@endsection

@section("links")
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css") }}">
<link rel="stylesheet" href="{{ asset("assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css") }}">
@endsection

@section("content")
<a href="{{ route("student.home") }}">
    <i class="mdi mdi-arrow-left"></i> Go back
</a>
<div class="row mb-4 mt-1 g-4">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="mb-2 text-nowrap">Book Details</h4>
                <p class="mb-0">
                    <span class="text-primary">Uploader Name: </span> <span>{{ $book->user->fullname }}</span>  
                  </p>
                <p class="mb-0">
                  <span class="text-primary">College: </span> <span>{{ $book->college->name }}</span>  
                </p>
                <p class="mb-0">
                    <span class="text-primary">Book Type: </span> @foreach ($book->typeArray() as $type) <span class="badge bg-primary text-uppercase">{{ $type }}</span>  @endforeach 
                </p>
                <p class="mb-0">
                    <span class="text-primary">Date Published: </span> {{ $book->published_at->format("F d, Y") }}
                </p>
                <p class="mb-0">
                    <span class="text-primary">Book Status: </span> <span class="badge bg-{{ $book->statusColor() }}">{{ $book->statusText() }}</span>
                </p>
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
                    <div class="d-flex align-items-center gap-3">
                      <small>5 Star</small>
                      <div class="progress w-100 rounded" style="height: 10px">
                        <div
                          class="progress-bar bg-primary"
                          role="progressbar"
                          style="width: 50%"
                          aria-valuenow="50"
                          aria-valuemin="0"
                          aria-valuemax="100"></div>
                      </div>
                      <small class="w-px-20 text-end">1</small>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <small>4 Star</small>
                        <div class="progress w-100 rounded" style="height: 10px">
                          <div
                            class="progress-bar bg-primary"
                            role="progressbar"
                            style="width: 50%"
                            aria-valuenow="50"
                            aria-valuemin="0"
                            aria-valuemax="100"></div>
                        </div>
                        <small class="w-px-20 text-end">1</small>
                      </div>
                      <div class="d-flex align-items-center gap-3">
                        <small>3 Star</small>
                        <div class="progress w-100 rounded" style="height: 10px">
                          <div
                            class="progress-bar bg-primary"
                            role="progressbar"
                            style="width: 0%"
                            aria-valuenow="0"
                            aria-valuemin="0"
                            aria-valuemax="100"></div>
                        </div>
                        <small class="w-px-20 text-end">0</small>
                      </div>
                      <div class="d-flex align-items-center gap-3">
                        <small>2 Star</small>
                        <div class="progress w-100 rounded" style="height: 10px">
                          <div
                            class="progress-bar bg-primary"
                            role="progressbar"
                            style="width: 0%"
                            aria-valuenow="0"
                            aria-valuemin="0"
                            aria-valuemax="100"></div>
                        </div>
                        <small class="w-px-20 text-end">0</small>
                      </div>
                      <div class="d-flex align-items-center gap-3">
                        <small>1 Star</small>
                        <div class="progress w-100 rounded" style="height: 10px">
                          <div
                            class="progress-bar bg-primary"
                            role="progressbar"
                            style="width: 0%"
                            aria-valuenow="0"
                            aria-valuemin="0"
                            aria-valuemax="100"></div>
                        </div>
                        <small class="w-px-20 text-end">0</small>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="mb-0 card-title">Reviews</h4>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <table class="datatable-init table table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-start">Researcher Name</th>
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

@endsection

@section("scripts")
    <script src="{{ asset("assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js") }}"></script>
    <script>
         $(".datatable-init").DataTable({
            order: [[3, "desc"], [2, "desc"]]
         });
    </script>
@endsection