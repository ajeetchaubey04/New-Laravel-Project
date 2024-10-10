<!-- Start Edit Shop Modal -->
<div class="modal fade" id="edit-ajax-modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Shop</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.app-data.shop.update') }}" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($shop->id) }}">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control input-default name" name="shop_name" required
                                    placeholder="Shop Name" value="{{ old('shop_name', $shop->shop_name) }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control input-default owner_name" name="owner_name" required
                                    placeholder="Owner Name"
                                    value="{{ old('owner_name', $shop->owner_name) }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control input-default shop_address" name="shop_address" required
                                    placeholder="Shop Address" value="{{ old('shop_address', $shop->shop_address) }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input  type="file" class="custom-file-input"
                                        name="request_shop_image" accept="image/*">
                                    <label class="custom-file-label">Shop Image</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input  type="file" class="custom-file-input"
                                        name="request_shop_bill" accept="image/*">
                                    <label class="custom-file-label">Shop Bill</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input  type="file" class="custom-file-input"
                                        name="request_shop_pancard" accept="image/*">
                                    <label class="custom-file-label">Owner PanCard</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input  type="file" class="custom-file-input"
                                        name="request_shop_trade_lic" accept="image/*">
                                    <label class="custom-file-label">Shop Trade Lic</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input  type="file" class="custom-file-input"
                                        name="request_shop_cheque" accept="image/*">
                                    <label class="custom-file-label">Shop Cheque</label>
                                </div>
                            </div>
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
<!-- End Edit Shop Modal -->
