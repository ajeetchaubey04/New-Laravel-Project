<!-- Start Edit Products Modal -->
<div class="modal fade" data-focus="false" id="edit-ajax-modal" data-focus="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Products Section</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.products.update') }}" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($product->id) }}">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control input-default name"
                            value="{{ old('name', $product->name) }}" name="name" required placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-default description"
                            value="{{ old('description', $product->description) }}" name="description" required
                            placeholder="Description">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-default price"
                            value="{{ old('price', $product->price) }}" name="price" required placeholder="Price">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-default quantity"
                            value="{{ old('quantity', $product->quantity) }}" name="quantity" required
                            placeholder="Quantity">
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="request_featured_product"
                                accept=".png, .jpg, .jpeg, .webp">
                            <label class="custom-file-label">Featured Image</label>
                        </div>
                    </div>
                    <div class="row">
                        @if ($product->featuredImage)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{ ucwords(str_replace('_', ' ', $product->featuredImage->type)) }}</label>
                                    <a href="{{ asset($product->featuredImage->file) }}" target="_blank">
                                        <img loading="lazy" width="100%"
                                            src="{{ asset($product->featuredImage->file) }}"
                                            alt="{{ $product->featuredImage->type }}">
                                    </a>
                                </div>
                            </div>
                        @endif
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
<!-- End Edit Blog Modal -->
