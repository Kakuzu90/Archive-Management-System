@extends("layouts.app")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    System Settings
    @endif
@endsection

@section("links")
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/quill/typography.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/quill/katex.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/quill/editor.css") }}" />
@endsection

@section("content")

<h4 class="py-3 mb-4"><span class="text-muted fw-light">System Settings /</span> Settings</h4>

<div class="card">
   <div class="card-body">
        <h5 class="card-title">System About</h5>
        <div class="form-control p-0 pt-1 mb-3">
            <div class="about-toolbar border-0 border-bottom">
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
            <div class="about-editor border-0 pb-1" id="about-editor">
                {!! $settings[0]->context !!}
            </div>
        </div>
        <h5 class="card-title">Policy & Terms</h5>
        <div class="form-control p-0 pt-1 mb-3">
            <div class="terms-toolbar border-0 border-bottom">
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
            <div class="terms-editor border-0 pb-1" id="terms-editor">
                {!! $settings[1]->context !!}
            </div>
        </div>
        <form action="{{ route("admin.settings.store") }}" method="POST">
            @csrf
            @method("PUT")
            <input type="hidden" id="about" name="about" />
            <input type="hidden" id="terms" name="terms" />
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
   </div>
</div>
@endsection

@section("scripts")
    <script src="{{ asset("assets/vendor/libs/quill/katex.js") }}"></script>
    <script src="{{ asset("assets/vendor/libs/quill/quill.js") }}"></script>

    <script>
        const aboutEditor = document.querySelector('.about-editor');
        const termsEditor = document.querySelector('.terms-editor');

        if (aboutEditor) {
            new Quill(aboutEditor, {
                modules: {
                    toolbar: '.about-toolbar'
                },
                placeholder: 'Write here',
                theme: 'snow'
            });
        }

        if (termsEditor) {
            new Quill(termsEditor, {
                modules: {
                    toolbar: '.terms-toolbar'
                },
                placeholder: 'Write here',
                theme: 'snow'
            });
        }

        document.querySelector('form').onsubmit = function() {
            const quill = document.querySelectorAll('.ql-editor');
            $("input[name=about]").val(quill[0].innerHTML)
            $("input[name=terms]").val(quill[1].innerHTML)
        };
    </script>
@endsection