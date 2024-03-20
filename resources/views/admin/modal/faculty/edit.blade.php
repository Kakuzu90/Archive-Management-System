<div class="modal fade" id="edit" tabindex="-1" aria-hidden="true" aria-describedby="editTitle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="POST">
        @csrf
        @method("PUT")
            <div id="form_loader" class="d-flex justify-content-center align-items-center my-5">
                <div class="sk-circle-fade sk-primary">
                    <div class="sk-circle-fade-dot"></div>
                    <div class="sk-circle-fade-dot"></div>
                    <div class="sk-circle-fade-dot"></div>
                    <div class="sk-circle-fade-dot"></div>
                    <div class="sk-circle-fade-dot"></div>
                    <div class="sk-circle-fade-dot"></div>
                    <div class="sk-circle-fade-dot"></div>
                    <div class="sk-circle-fade-dot"></div>
                    <div class="sk-circle-fade-dot"></div>
                    <div class="sk-circle-fade-dot"></div>
                    <div class="sk-circle-fade-dot"></div>
                    <div class="sk-circle-fade-dot"></div>
                </div>
            </div>
            <div id="form_container" class="d-none">
                <div class="modal-header">
                    <h4 class="modal-title" id="editTitle">Edit Faculty</h4>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-sm-6">
                          <div class="form-floating form-floating-outline">
                            <input
                              type="text"
                              id="first_name1"
                              name="first_name"
                              class="form-control"
                              placeholder="Enter your first name"
                              autofocus
                              />
                            <label for="first_name1">First Name</label>
                          </div>
                        </div>
        
                        <div class="col-sm-6">
                          <div class="form-floating form-floating-outline">
                            <input
                              type="text"
                              id="middle_name1"
                              name="middle_name"
                              class="form-control"
                              placeholder="Enter you middle name" />
                            <label for="middle_name1">Middle Name</label>
                          </div>
                        </div>
        
                        <div class="col-sm-6">
                          <div class="form-floating form-floating-outline">
                            <input
                              type="text"
                              id="last_name1"
                              name="last_name"
                              class="form-control"
                              placeholder="Enter your last name" />
                            <label for="last_name1">Last Name</label>
                          </div>
                        </div>
        
                        <div class="col-sm-6">
                          <div class="form-floating form-floating-outline">
                            <input
                              type="text"
                              id="username1"
                              name="username"
                              class="form-control"
                              placeholder="Enter your username" />
                            <label for="username1">Username</label>
                          </div>
                        </div>
          
                        <div class="col-sm-6">
                          <div class="form-password-toggle">
                            <div class="input-group input-group-merge">
                              <div class="form-floating form-floating-outline">
                                <input
                                  type="password"
                                  id="password1"
                                  class="form-control"
                                  name="password"
                                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                  aria-describedby="password" />
                                <label for="password1">Password</label>
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
                                  id="password_confirmation1"
                                  class="form-control"
                                  name="password_confirmation"
                                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                  aria-describedby="password_confirmation" />
                                <label for="password_confirmation1">Confirm Password</label>
                              </div>
                              <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                            </div>
                          </div>
                        </div>
        
                        <div class="col-sm-12">
                          <div class="form-floating form-floating-outline">
                            <select
                              class="select2 form-select form-select-lg"
                              id="college1"
                              name="college"
                            >
                              @foreach (getColleges() as $item)
                                <option value="{{ $item->id }}">
                                  {{ $item->name }}
                                </option>
                              @endforeach
                            </select>
                            <label for="college1">College</label>
                          </div>
                        </div>
        
                        <div class="col-sm-12">
                          <div class="form-floating form-floating-outline">
                            <select
                              class="select2-avatar form-select form-select-lg"
                              id="avatar1"
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
                            <label for="avatar1">Avatar</label>
                          </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="text-light small fw-medium mb-1">Account Status</div>
                            <label class="switch switch-success switch-square">
                              <input type="checkbox" class="switch-input" name="status" />
                              <span class="switch-toggle-slider">
                                <span class="switch-on"></span>
                                <span class="switch-off"></span>
                              </span>
                              <span class="switch-label">Verified</span>
                            </label>
                        </div>
        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                    </button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>