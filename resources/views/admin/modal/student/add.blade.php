<div class="modal fade" id="add" tabindex="-1" aria-hidden="true" aria-describedby="addTitle">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addTitle">New Student</h4>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
            </div>
        <form action="{{ route("admin.students.store") }}" method="POST">
        @csrf
        <div class="modal-body">
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
                          aria-describedby="password" required />
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
                          aria-describedby="password_confirmation" required />
                        <label for="password_confirmation">Confirm Password</label>
                      </div>
                      <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                  </div>
                </div>

                <div class="col-sm-9">
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

                <div class="col-sm-3">
                    <div class="form-floating form-floating-outline">
                      <select
                        class="select2 form-select form-select-lg"
                        id="year"
                        name="year"
                        required
                      >
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                        <option value="5th Year">5th Year</option>
                      </select>
                      <label for="year">Year Level</label>
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Save Student</button>
        </div>
        </form>
        </div>
    </div>
</div>