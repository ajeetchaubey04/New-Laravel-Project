<!-- Start Edit Membership Modal -->
<div class="modal fade" data-focus="false" id="edit-ajax-modal" data-focus="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Membership Plan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.membership.update') }}" autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($membership->id) }}">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control input-default name"
                            value="{{ old('name',$membership->name) }}" name="name" required placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-default email"
                            value="{{ old('email',$membership->email) }}" name="email" required placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-default phoneno"
                            value="{{ old('phoneno',$membership->phoneno) }}" name="phoneno" required placeholder="Phone No.">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-default membershiptype"
                            value="{{ old('membershiptype',$membership->membershiptype) }}" name="membershiptype" required
                            placeholder="Membership Type">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control input-default dob"
                            value="{{ old('dob',$membership->dob) }}" name="dob" required placeholder="Date Of Birth">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-default country"
                            value="{{ old('country',$membership->country) }}" name="country" required placeholder="Country">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control input-default ckeditor" name="message" cols="60" rows="8"
                            placeholder="Message">{{ old('message',$membership->message) }}</textarea>
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
