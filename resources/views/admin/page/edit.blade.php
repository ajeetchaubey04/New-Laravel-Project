<!-- Start Add Page Modal -->
<div class="modal fade" id="edit-ajax-modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Page</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.page.update') }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($page->id) }}">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control input-default" id="page" name="title"
                            required placeholder="Enter Title" value="{{ old('title', $page->title) }}" >
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control input-default" id="slug" name="slug"
                            required placeholder="Enter Slug"  value="{{ old('slug', $page->slug) }}" readonly>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control input-default description" name="description" id="description" cols="30"
                            rows="2" placeholder="Enter Description">{{ old('description', $page->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <textarea style="width: 100%;" class="form-control input-default edit-ckeditor" name="post" cols="30"
                            rows="10" placeholder="Enter Post">{{ old('post', $page->post) }}</textarea>
                    </div>

                    <div class="form-group">
                        <textarea style="width: 100%;" class="form-control input-default excerpt" name="excerpt" id="excerpt" cols="30"
                            rows="5" placeholder="Enter excerpt">{{ old('excerpt', $page->excerpt) }}</textarea>
                    </div>

                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="request_featured_image"
                                accept="image/*">
                            <label class="custom-file-label">Featured Image</label>
                        </div>
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
<!-- End Add Page Modal -->
