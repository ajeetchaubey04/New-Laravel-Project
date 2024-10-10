<!-- Start Edit Processing Fee Modal -->
<div class="modal fade" id="edit-ajax-modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Processing Fee</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.app-data.processing.update') }}">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($processing->id) }}">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <select class="multi-select" id="edit-ajax-select" required name="finance_type_id" data-live-search="true"
                            data-width="100%">
                            <option value=""> Select Finance Type</option>
                            @foreach ($finances as $finance)
                                <option value="{{ $finance->id }}"
                                    {{ old('finance_type_id', $processing->finance_type_id) == $finance->id ? 'selected' : '' }}>
                                    {{ $finance->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control input-default price" id="price"
                            name="price" required placeholder="Price" value="{{ $processing->price }}">
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control input-default start_price" id="start_price"
                            name="start_price" required placeholder="Start Price" value="{{ $processing->start_price }}">
                    </div>
                    
                    <div class="form-group">
                        <input type="number" class="form-control input-default end_price" id="end_price"
                            name="end_price" required placeholder="End Price" value="{{ $processing->end_price }}">
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
<!-- End Edit Processing Fee Modal -->