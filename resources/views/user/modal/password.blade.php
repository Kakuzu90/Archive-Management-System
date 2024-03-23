<div class="modal fade" id="change" tabindex="-1" aria-hidden="true" aria-describedby="changeTitle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="changeTitle">Change Password</h4>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
            </div>
        <form action="{{ changeRoute("student.profile.password") }}" method="POST">
        @csrf
        @method("PATCH")
        <div class="modal-body">
            <div class="row">
                <div class="col-12 mb-2">
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
                <div class="col-12 mb-2">
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
                <div class="col-12">
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Save New Password</button>
        </div>
        </form>
        </div>
    </div>
</div>