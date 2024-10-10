<!-- Start Edit Role Modal -->
<div class="modal fade" id="edit-ajax-modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.user-management.role.update') }}">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ base64_encode($role->id) }}">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control input-default role" id="role" name="title"
                            required placeholder="Role" value="{{ $role->title }}">
                    </div>
                    <div class="form-group">
                        <select class="multi-select" required name="permissions[]" data-live-search="true" id="edit-ajax-select"
                            data-width="100%" multiple="multiple">
                            @foreach ($permissions as $permission)
                                <option {{ in_array($permission->id, old('permissions', [])) || $role->permissions->contains($permission->id) ? 'selected' : '' }} value="{{ $permission->id }}">{{ $permission->title }}</option>
                            @endforeach
                        </select>
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
<!-- End Edit Role Modal -->
