<?php

namespace App\Http\Controllers\Admin\UserManagement\Role;

use Gate;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class RoleController extends Controller
{
    public function index($items = 10)
    {
        // abort_if(Gate::denies('role_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['items'] = $items;
        $data['lists'] = Role::orderBy('id', 'ASC')->withTrashed()->paginate($items);
        $data['permissions'] = Permission::select('id', 'title')->whereStatus(1)->orderBy('title', 'ASC')->get();
        $data['page_title'] = 'Roles List';
        $data['page_description'] = 'Roles List';
        return view('admin.user-management.role.index', $data);
    }

    public function store(Request $request)
    {
        // abort_if(Gate::denies('role_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->validate($request, [
            'title' => 'required|min:4',
            'permissions' => 'required|array'
        ]);

        $save = Role::Create($request->all());
        if ($save) {
            $save->permissions()->sync($request->input('permissions', []));
            return redirect()->back()->with('success', 'Role Added');
        }
        return redirect()->back()->with('error', 'Something Went wrong');
    }

    public function edit(Request $request, $id)
    {
        // abort_if(Gate::denies('permission_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Role::with('permissions')->find($id);
            if ($find) {
                $data['role'] = $find;
                $data['permissions'] = Permission::select('id', 'title')->whereStatus(1)->orderBy('title', 'ASC')->get();
                return response()->json(['success' => true, 'message' => 'Edit Role', 'data' => view('admin.user-management.role.edit', $data)->render()]);
            }
            return response()->json(['success' => false, 'message' => 'Role Not Found'], 404);
        }
        abort(403);
    }

    public function update(Request $request)
    {
        // abort_if(Gate::denies('role_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->validate($request, [
            'title'       => 'required|min:4',
            'id'          => 'required',
            'permissions' => 'required|array'
        ]);

        $id = base64_decode($request->id);
        $find = Role::find($id);
        if ($find) {
            $find->title = $request->title;
            $find->save();
            $find->permissions()->sync($request->input('permissions', []));
            return redirect()->back()->with('success', 'Roles Updated');
        }
        return redirect()->back()->with('error', 'Something Went wrong');
        abort('404');
    }

    public function status(Request $request, $id)
    {
        // abort_if(Gate::denies('role_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Role::find($id);
            if ($find) {
                $find->status = $find->status == 1 ? 0 : 1;
                $find->save();
                return response()->json(['success' => true, 'message' => 'Role Status Changed'], 200);
            }
            return response()->json(['success' => false, 'message' => 'Role Not Found'], 404);
        }
        abort(403);
    }

    public function destroy(Request $request, $id)
    {
        // abort_if(Gate::denies('permission_destroy'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Role::find($id);
            if ($find) {
                $find->delete();
                return response()->json(['success' => true, 'message' => 'Role Deleted'], 200);
            }
            return response()->json(['success' => false, 'message' => 'Role Not Found'], 404);
        }
        abort(403);
    }

    public function permanentDelete(Request $request, $id)
    {
        // abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Role::onlyTrashed()->find($id);
            if ($find) {
                $find->forceDelete();
                return response()->json(['success' => true, 'message' => 'Role Deleted Permanently'], 200);
            }
            return response()->json(['success' => false, 'message' => 'Role Not Found'], 404);
        }
        abort(403);
    }

    public function restore(Request $request, $id)
    {
        // abort_if(Gate::denies('permission_restore'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Role::onlyTrashed()->find($id);
            if ($find) {
                $find->restore();
                return response()->json(['success' => true, 'message' => 'Role Restored'], 200);
            }
            return response()->json(['success' => false, 'message' => 'Role Not Found'], 404);
        }
        abort(403);
    }
}
