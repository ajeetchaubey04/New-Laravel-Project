<!-- Start Edit Bank Modal -->
<div class="modal fade" id="edit-ajax-modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" bank="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Bank</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.app-data.bank.update') }}">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($bank->id) }}">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control input-default bank" id="bank" name="title"
                            required placeholder="Bank" value="{{ $bank->title }}">
                    </div>
                    
                    <div class="form-group">
                        <input type="number" min="1" step='0.05' class="form-control input-default interest" id="interest"
                            name="interest" required placeholder="Enter Interest" value="{{ $bank->interest }}">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End Edit Bank Modal -->