@extends("layouts.auth")

@section("title")
    Register
@endsection

@section("links")
  <link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-select/bootstrap-select.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/vendor/libs/select2/select2.css") }}">
  <style>
    .authentication-wrapper.authentication-basic .authentication-inner {
      max-width: 650px;
    }
    @media (max-width: 450px) {
      .authentication-wrapper.authentication-basic .authentication-inner {
        max-width: 95%;
      }
    }
  </style>
@endsection

@section("content")
<div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Login -->
        <div class="card p-2">
          <!-- Logo -->
          <div class="app-brand justify-content-center mt-5">
            <a href="{{ route("index") }}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <img src="{{ asset("favicon.png") }}" width="35" height="35" alt="Brand Logo" />
              </span>
              <span class="app-brand-text demo text-heading fw-bold">Capstone Project Hub</span>
            </a>
          </div>
          <!-- /Logo -->

          <div class="card-body mt-2">
            <h4 class="mb-2">Join Now!</h4>
            <p class="mb-3">Register to experience streamlined organization and secure access for your capstone projects.</p>

            <form id="formAuthentication" class="mb-3" action="{{ route("register.faculty") }}" method="POST">
              @csrf

              <div class="row g-3">

                <div class="col-sm-6">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="first_name"
                      name="first_name"
                      class="form-control"
                      placeholder="Enter your first name"
                      autofocus
                      />
                    <label for="first_name">First Name</label>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="middle_name"
                      name="middle_name"
                      class="form-control"
                      placeholder="Enter you middle name" />
                    <label for="middle_name">Middle Name</label>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="last_name"
                      name="last_name"
                      class="form-control"
                      placeholder="Enter your last name" />
                    <label for="last_name">Last Name</label>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="username"
                      name="username"
                      class="form-control"
                      placeholder="Enter your username" />
                    <label for="username">Username</label>
                  </div>
                </div>
  
                <div class="col-sm-6">
                  <div class="form-password-toggle">
                    <div class="input-group input-group-merge">
                      <div class="form-floating form-floating-outline">
                        <input
                          type="password"
                          id="password"
                          class="form-control"
                          name="password"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password" />
                        <label for="password">Password</label>
                      </div>
                      <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                  </div>
                </div>
  
                <div class="col-sm-6">
                  <div class="form-password-toggle">
                    <div class="input-group input-group-merge">
                      <div class="form-floating form-floating-outline">
                        <input
                          type="password"
                          id="password_confirmation"
                          class="form-control"
                          name="password_confirmation"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password_confirmation" />
                        <label for="password_confirmation">Confirm Password</label>
                      </div>
                      <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-floating form-floating-outline">
                    <select
                      class="select2 form-select form-select-lg"
                      id="college"
                      name="college"
                    >
                      @foreach ($colleges as $item)
                        <option value="{{ $item->id }}">
                          {{ $item->name }}
                        </option>
                      @endforeach
                    </select>

                  </div>
                </div>

              </div>

              <div class="my-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                  <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <a href="javascript:void(0);">privacy policy & terms</a>
                  </label>
                </div>
              </div>

              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Register</button>
              </div>
            </form>

            <p class="text-center">
              <span>Already have an account?</span>
              <a href="{{ route("login") }}">
                <span>Sign in instead</span>
              </a>
            </p>

          </div>
        </div>

        <img
          alt="mask"
          src="{{ asset("assets/img/illustrations/auth-basic-register-mask-light.png") }}"
          class="authentication-image d-none d-lg-block"
          data-app-light-img="illustrations/auth-basic-register-mask-light.png"
          data-app-dark-img="illustrations/auth-basic-register-mask-dark.png" />
      </div>
    </div>
  </div>
@endsection


@section("scripts")
  <script src="{{ asset("assets/vendor/libs/select2/select2.js") }}"></script>
  <script>
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
  </script>
@endsection