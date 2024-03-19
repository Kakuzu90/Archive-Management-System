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
                    <h4 class="modal-title" id="editTitle">Edit Course</h4>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-4 mt-2">
                          <div class="form-floating form-floating-outline">
                            <input type="text" id="course1" name="name" class="form-control" placeholder="Course Name" required />
                            <label for="course1">Course Name</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-floating form-floating-outline">
                            <select
                              class="select2 form-select form-select-lg"
                              id="college1"
                              name="college"
                              required
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