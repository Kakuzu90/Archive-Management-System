@extends("layouts.app")

@section("title")
    @if (Session::get("status"))
    Welcome {{ auth()->user()->fullname }}
    @else
    My Profile
    @endif
@endsection

@section("links")
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/bootstrap-select/bootstrap-select.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/vendor/libs/select2/select2.css") }}">
    <style>
        .select2-selection__rendered .avatar img {
            margin-top: -19px;
        }
    </style>
@endsection

@section("content")
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
<div class="card mb-4">
    <h5 class="card-header mb-0">Profile Details</h5>
    <div class="card-body">
        <form action="{{ route("admin.profile.general") }}" method="POST">
        @csrf
        @method("PUT")
        <div class="row gy-4 justify-content-center">
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="form-floating form-floating-outline">
                  <input
                    class="form-control"
                    type="text"
                    id="first_name"
                    name="first_name"
                    value="{{ $user->first_name }}"
                    autofocus required/>
                  <label for="first_name">First Name</label>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="form-floating form-floating-outline">
                  <input
                    class="form-control"
                    type="text"
                    id="middle_name"
                    name="middle_name"
                    value="{{ $user->middle_name }}"
                    />
                  <label for="middle_name">Middle Name</label>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="form-floating form-floating-outline">
                  <input
                    class="form-control"
                    type="text"
                    id="last_name"
                    name="last_name"
                    value="{{ $user->last_name }}"
                    required/>
                  <label for="last_name">Last Name</label>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="form-floating form-floating-outline">
                  <input
                    class="form-control"
                    type="text"
                    id="username"
                    name="username"
                    value="{{ $user->username }}"
                    required/>
                  <label for="username">Username</label>
                </div>
            </div>
            @admin
            <div class="col-xl-4 col-lg-4 col-md-6">
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
            <div class="col-xl-4 col-lg-4 col-md-6">
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
            @endadmin
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" required />
                      <label for="password">Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                  </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
    </div>
</div>

<div class="card">
    <h5 class="card-header mb-0">Change Password</h5>
    <div class="card-body">
        <form action="{{ route("admin.profile.password") }}" method="POST">
        @csrf
        @method("PATCH")
            <div class="row gy-4 mb-3">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="form-password-toggle">
                      <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="password"
                            id="password1"
                            class="form-control"
                            name="old"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password1" required />
                          <label for="password1">Current Password</label>
                        </div>
                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                      </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="form-password-toggle">
                      <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="password"
                            id="password2"
                            class="form-control"
                            name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password2" required />
                          <label for="password2">New Password</label>
                        </div>
                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                      </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="form-password-toggle">
                      <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                          <input
                            type="password"
                            id="password3"
                            class="form-control"
                            name="password_confirmation"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password3" required />
                          <label for="password3">Confirm New Password</label>
                        </div>
                        <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                      </div>
                    </div>
                </div>
            </div>
            <h6 class="text-body">Password Requirements:</h6>
            <ul class="ps-3 mb-0">
                <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                <li class="mb-1">At least one lowercase character</li>
                <li>At least one number, symbol, or whitespace character</li>
            </ul>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">Save changes</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section("scripts")
    <script src="{{ asset("assets/vendor/libs/select2/select2.js") }}"></script>
    <script>
        @admin
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
        if (select2Avatars.length) {
            function renderIcons(option) {
                if (!option.id) {
                return option.text;
                }

                var $icon = "<div class='d-flex justify-content-start align-items-center'><div class='avatar avatar-sm me-1'><img src='"+ $(option.element).data('src') +"' class='rounded-circle' alt='Avatar' /></div>" + option.text + "</div>";

                return $icon;
            }
            select2Avatars.each(function() {
                var $this = $(this);
                select2Focus($this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    minimumResultsForSearch: Infinity,
                    placeholder: 'Select avatar',
                    dropdownParent: $this.parent(),
                    templateResult: renderIcons,
                    templateSelection: renderIcons,
                    escapeMarkup: function (es) {
                        return es;
                    }
                });
            });
        }
        $("select[name=college]").val('{{ $user->college_id }}').trigger("change")
        $("select[name=avatar]").val('{{ $user->avatar }}').trigger("change")
        @endadmin
    </script>
@endsection