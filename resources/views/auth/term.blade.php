<div class="modal fade" data-bs-backdrop="static" id="add" tabindex="-1" aria-hidden="true" aria-describedby="addTitle">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addTitle">Privacy Policy & Terms</h4>
            </div>
            <div class="modal-body">
                {!! getTerms()->context !!}
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="btn btn-primary btn-accept">Accept</button>
            </div>
        </div>
    </div>
</div>