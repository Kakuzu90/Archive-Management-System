<div class="modal fade" id="add" tabindex="-1" aria-hidden="true" aria-describedby="addTitle">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <form action="{{ changeRoute("student.book.store", $pdf->slug) }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="d-flex justify-content-center mb-2">
                <div class="set-rateyo"></div>
            </div>
            <div class="form-floating form-floating-outline mb-4">
                <textarea
                    class="form-control h-px-100"
                    id="comment"
                    name="comment"
                    required
                    placeholder="Comments here..."></textarea>
                <label for="comment">Comment</label>
            </div>
        </div>
        <div class="modal-footer text-center">
            <input type="hidden" name="rate">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </div>
        </form>
        </div>
    </div>
</div>