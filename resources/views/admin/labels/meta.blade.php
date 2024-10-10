<!-- Start Meta Label Modal -->
<div class="modal fade" id="edit-ajax-modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Meta Label</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.label.meta-store') }}" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($label->id) }}">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label>Meta Title</label>
                        <input type="text" class="form-control input-default title"
                            value="{{ old('title', $label->title) }}" name="title" required placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label>Meta Keywords</label>
                        <input type="text" class="form-control input-default keywords"
                            value="{{ old('slug', $label->keywords) }}" name="keywords" required
                            placeholder="Keywords">
                    </div>

                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea class="form-control input-default" name="description" cols="30" rows="2"
                            placeholder="Enter Description">{{ old('description', $label->description) }}</textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End Meta Label Modal -->
