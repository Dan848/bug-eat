<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-bg-primary">
                <h1 class="modal-title fs-5" id="deleteModalTitle">ATTENZIONE!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Sicuro di voler <span class="fw-medium text-danger">ELIMINARE</span> <span class="fw-bolder"
                        id="deleteModalItemTitle"></span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Back</button>
                <button type="button" class="btn btn-primary delete-modal-button">Delete</button>
            </div>
        </div>
    </div>
</div>
