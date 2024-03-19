@extends("layouts.default")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    Home Page
    @endif
@endsection

@section("links")

@endsection

@section("content")
    <div class="row justify-content-center">
        @forelse (getBooks() as $item)
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{ asset("assets/img/pages/profile-banner.png") }}" alt="Banner Image" />
                <div class="card-body">
                    <h6 class="card-title text-center text-primary">{{ $item->title }}</h6>

                    <p class="mb-1">
                        <span class="text-dark">Uploaded By: </span> <span class="badge bg-primary">{{ $item->user->fullname }}</span>
                    </p>
                    <p class="mb-1">
                        <span class="text-dark">Authors: </span> @foreach($item->authorArray() as $author) <span class="badge bg-success">{{ $author }}</span> @endforeach
                    </p>
                    <p class="mb-1">
                        <span class="text-dark">Book Type: </span> @foreach($item->typeArray() as $type) <span class="badge bg-primary">{{ $type }}</span> @endforeach
                    </p>
                    <p class="mb-1">
                        <span class="text-dark">College: </span> <span class="text-dark">{{ $item->college->name }}</span>
                    </p>
                    <p class="mb-1">
                        <span class="text-dark">Date Published: </span> <span class="text-dark">{{ $item->published_at->format("F d, Y") }}</span>
                    </p>
                    <p class="mb-1">
                        <span class="text-dark">Rating: </span> <span class="text-dark">{{ $item->average() }} <i class="mdi mdi-star"></i></span>
                    </p>

                    <p class="mb-4">
                        <span class="text-dark">Downloads: </span> <span class="text-dark">{{ $item->downloads->count() }} <i class="mdi mdi-download"></i></span>
                    </p>

                    <a
                        href="{{ route("student.book", $item->id) }}"
                        class="btn btn-outline-primary w-100"
                    >
                        See Details
                    </a>
                </div>
            </div>
        </div>
        @empty
            
        @endforelse
    </div>
@endsection