<div class="modal fade" id="add" tabindex="-1" aria-hidden="true" aria-describedby="addTitle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addTitle">New Course</h4>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
            </div>
        <form action="{{ route("admin.courses.store") }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-12 mb-4 mt-2">
                <div class="form-floating form-floating-outline">
                  <input type="text" id="course" name="name" class="form-control" placeholder="Course Name" required />
                  <label for="course">Course Name</label>
                </div>
              </div>
              <div class="col-12">
                <div class="form-floating form-floating-outline">
                  <select
                    class="select2 form-select form-select-lg"
                    id="college"
                    name="college"
                    required
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
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Save Course</button>
        </div>
        </form>
        </div>
    </div>
</div>