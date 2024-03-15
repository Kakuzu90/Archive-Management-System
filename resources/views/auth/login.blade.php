@extends("layouts.auth")

@section("title")
    Login
@endsection

@section("links")
  <style>
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
            <h4 class="mb-2">Welcome</h4>
            <p class="mb-3">Efficiently manage your capstone projects with our intuitive web-based system.</p>
            <form id="formAuthentication" class="mb-3" action="{{ route("login") }}" method="POST">
              @csrf
              <div class="form-floating form-floating-outline mb-3">
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  name="username"
                  placeholder="Enter your username"
                  autofocus />
                <label for="email">Username</label>
              </div>
              <div class="mb-3">
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
              <div class="mb-3 d-flex justify-content-between">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember-me" name="remember" value="1" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Login in</button>
              </div>
            </form>

            @error("login_failed")
            <div class="alert alert-danger alert-dismissible" role="alert">
              {{ $message }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror

            @error("logout")
            <div class="alert alert-warning alert-dismissible" role="alert">
              {{ $message }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror

            <p class="text-center mb-0">
              <span>New on our platform? Create an account</span>
            </p>
            <p class="text-center">
              <a href="{{ route("register.student") }}">
                <span>Student</span>
              </a>
              <span class="text-dark">or</span>
              <a href="{{ route("register.faculty") }}">
                <span>Faculty</span>
              </a>
            </p>

          </div>
        </div>

        <img
          alt="mask"
          src="{{ asset("assets/img/illustrations/auth-basic-login-mask-light.png") }}"
          class="authentication-image d-none d-lg-block"
          data-app-light-img="illustrations/auth-basic-login-mask-light.png"
          data-app-dark-img="illustrations/auth-basic-login-mask-dark.png" />
      </div>
    </div>
  </div>
@endsection