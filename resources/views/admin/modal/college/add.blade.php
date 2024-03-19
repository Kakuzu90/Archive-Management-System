<div class="modal fade" id="add" tabindex="-1" aria-hidden="true" aria-describedby="addTitle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addTitle">New College</h4>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
            </div>
        <form action="{{ route("admin.colleges.store") }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col mb-4 mt-2">
                <div class="form-floating form-floating-outline">
                  <input type="text" id="college" name="name" class="form-control" placeholder="College Name" required />
                  <label for="college">College Name</label>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Save College</button>
        </div>
        </form>
        </div>
    </div>
</div>