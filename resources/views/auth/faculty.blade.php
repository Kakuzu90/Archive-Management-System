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
    .select2-selection__rendered .avatar img {
      margin-top: -19px;
    }
  </style>
@endsection

@section("content")
<div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <div class="card p-2">

          <div class="app-brand justify-content-center mt-5">
            <a href="{{ route("index") }}" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <img src="{{ asset("favicon.png") }}" width="35" height="35" alt="Brand Logo" />
              </span>
              <span class="app-brand-text demo text-heading fw-bold">Capstone Project Hub</span>
            </a>
          </div>


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
                      value="{{ old('first_name') }}"
											autofocus
											required
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
											value="{{ old('middle_name') }}"
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
											value="{{ old('last_name') }}"
                      placeholder="Enter your last name" required />
                    <label for="last_name">Last Name</label>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-floating form-floating-outline">
                    <input
                      type="text"
                      id="username"
                      name="username"
											value="{{ old('username') }}"
                      class="form-control @error('username') is-invalid @enderror"
                      placeholder="Enter your username" required />
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
											required
                    >
                      @foreach ($colleges as $item)
                        <option value="{{ $item->id }}">
                          {{ $item->name }}
                        </option>
                      @endforeach
                    </select>
                    <label for="college">College</label>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-floating form-floating-outline">
                    <select
                      class="select2-avatar form-select form-select-lg"
                      id="avatar"
                      name="avatar"
                      required
                    >
                      <option value="2" data-src="{{ asset("assets/img/avatar/avatar-2.png") }}">Avatar 1</option>
                      <option value="3" data-src="{{ asset("assets/img/avatar/avatar-3.png") }}">Avatar 2</option>
                      <option value="4" data-src="{{ asset("assets/img/avatar/avatar-4.png") }}">Avatar 3</option>
                      <option value="5" data-src="{{ asset("assets/img/avatar/avatar-5.png") }}">Avatar 4</option>
                      <option value="6" data-src="{{ asset("assets/img/avatar/avatar-6.png") }}">Avatar 5</option>
                      <option value="7" data-src="{{ asset("assets/img/avatar/avatar-7.png") }}">Avatar 6</option>
                    </select>
                    <label for="avatar">Avatar</label>
                  </div>
                </div>

              </div>

              <div class="my-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required />
                  <label class="form-check-label" for="terms-conditions">
                    I agree to
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#add">privacy policy & terms</a>
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
                <span>Login instead</span>
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

  @include("auth.term")
@endsection


@section("scripts")
  <script src="{{ asset("assets/vendor/libs/select2/select2.js") }}"></script>
  <script>
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
      function renderIcons(option) {
        if (!option.id) {
          return option.text;
        }

        var $icon = "<div class='d-flex justify-content-start align-items-center'><div class='avatar avatar-sm me-1'><img src='"+ $(option.element).data('src') +"' class='rounded-circle' alt='Avatar' /></div>" + option.text + "</div>";

        return $icon;
      }
      select2Focus(select2Avatars);
        select2Avatars.wrap('<div class="position-relative"></div>').select2({
          minimumResultsForSearch: Infinity,
          placeholder: 'Select avatar',
          dropdownParent: select2Avatars.parent(),
          templateResult: renderIcons,
          templateSelection: renderIcons,
          escapeMarkup: function (es) {
            return es;
          }
      });

      $(document).on("click", '.btn-accept', function() {
        $("input[name=terms]").prop("checked", true);
      })
			$('select[name=college]').val('{{ old("college") }}').trigger('change')
			$('select[name=avatar]').val('{{ old("avatar") }}').trigger('change')
  </script>
@endsection