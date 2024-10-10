<!-- Start Meta Blog Modal -->
<div class="modal fade" id="edit-ajax-modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Meta Blog</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.page.meta-store') }}" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($category->id) }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Meta Title</label>
                        <input type="text" class="form-control input-default title"
                            value="{{ old('title', $category->title) }}" name="title" required placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label>Meta Keywords</label>
                        <input type="text" class="form-control input-default keywords"
                            value="{{ old('slug', $category->keywords) }}" name="keywords" required
                            placeholder="Keywords">
                    </div>

                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea class="form-control input-default" name="description" cols="30" rows="2"
                            placeholder="Enter Description">{{ old('description', $category->description) }}</textarea>
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
<!-- End Meta Blog Modal -->
