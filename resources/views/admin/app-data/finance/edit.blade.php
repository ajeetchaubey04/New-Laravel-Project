<!-- Start Edit Finance Type Modal -->
<div class="modal fade" id="edit-ajax-modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Finance Type</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.app-data.finance.update') }}">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($finance->id) }}">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control input-default finance" id="finance" name="title"
                            required placeholder="Finance Type" value="{{ $finance->title }}">
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
<!-- End Edit Finance Type Modal -->