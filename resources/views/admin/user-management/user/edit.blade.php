<!-- Start Edit User Modal -->
<div class="modal fade" id="edit-ajax-modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Retailer</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.user-management.user.update') }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($user->id) }}">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control input-default name" 
                            name="name" required placeholder="Name" value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control input-default email" 
                            name="email" required placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control input-default"
                            name="phone" required placeholder="Phone" maxlength="10" value="{{ old('phone', $user->phone) }}"
                            onkeypress="return /[0-9]/i.test(event.key)">
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control password" id="password" name="password"
                            required placeholder="New Password" minlength="8" >
                        <div class="input-group-append" onclick="passwordShowHide()">
                            <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <select class="multi-select" required name="roles[]" data-live-search="true"  id="edit-ajax-select"
                            data-width="100%" multiple="multiple">
                            @foreach ($roles as $role)
                                <option {{ in_array($role->id, old('roles', [])) || $user->roles->contains($role->id) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
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
<!-- End Edut User Modal -->
