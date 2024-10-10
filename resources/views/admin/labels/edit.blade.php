<!-- Start Edit Label Modal -->
<div class="modal fade" id="edit-ajax-modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Label</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.label.update') }}" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($label->id) }}">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control input-default title" value="{{ old('title', $label->title) }}"
                            name="title" required placeholder="Title">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control input-default slug" value="{{ old('slug', $label->slug) }}"
                            name="slug" required placeholder="Slug">
                    </div>

                    <div class="form-group">
                        <textarea class="form-control input-default ckeditor" name="description" cols="30" rows="2"
                            placeholder="Enter Label Description">{{ old('description', $label->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Type</label>
                        <select class="multi-select edit-ajax-select" name="type" data-live-search="true"
                            data-width="100%">
                            <option value="1" {{ old('type', $label->type) == 1 ? 'selected' : '' }}>
                                Relation </option>
                            <option value="0" {{ old('type', $label->type) == 0 ? 'selected' : '' }}>
                                Occasion </option>
                        </select>
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
<!-- End Edit Label Modal -->
