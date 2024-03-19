<div class="modal fade" id="delete" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" aria-describedby="deleteTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <form method="POST">
        @csrf
        @method("DELETE")
            <div class="modal-body">
                <div class="text-center">
                    <i class="mdi mdi-48px mdi-delete-alert"></i>
                    <h6 class="mt-2" id="deleteTitle">Are you sure you want to remove this data <span class="delete_data text-danger"></span>?</h6>
                    <div class="mb-3">
                        <p class="mb-1 text-start text-dark fw-bold">Please type your password to confirm.</p>
                        <div class="form-password-toggle">
                          <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                              <input
                                type="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            </div>
                            <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                          </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        No
                    </button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>