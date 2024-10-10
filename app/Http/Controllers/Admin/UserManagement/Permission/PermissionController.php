<?php

namespace App\Http\Controllers\Admin\UserManagement\Permission;

use Gate;
// use Hashids\Hashids;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends Controller
{
    // private $hashids;

    public function __construct()
    {
        // $this->hashids = new Hashids('admin', 5);
    }

    public function index($items = 10)
    {
        // abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['items'] = $items;
        $data['lists'] = Permission::orderBy('id', 'ASC')->withTrashed()->paginate($items);
        $data['page_title'] = 'Permission List';
        $data['page_description'] = 'Permission List';
        return view('admin.user-management.permission.index', $data);
    }

    public function store(Request $request)
    {
        // abort_if(Gate::denies('permission_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->validate($request, [
            'title' => 'required|min:5|unique:permissions',
        ]);

        $save = Permission::Create($request->all());
        if ($save) {
            return redirect()->back()->with('success', 'Permission Added');
        }
        return redirect()->back()->with('error', 'Something Went wrong');
    }

    public function edit(Request $request, $id)
    {
        // abort_if(Gate::denies('permission_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Permission::find($id);
            if ($find) {
                $data['permission'] = $find;
                return response()->json(['success' => true, 'message' => 'Edit Permission', 'data' => view('admin.user-management.permission.edit', $data)->render()]);
            }
            return response()->json(['success' => false, 'message' => 'Permission Not Found'], 404);
        }
        abort(403);
    }

    public function update(Request $request)
    {
        // abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->validate($request, [
            'title' => 'required|min:5|unique:permissions,id,:id',
            'id' => 'required',
        ]);
        
        $id = base64_decode($request->id);
        $permission = Permission::find($id);
        if ($permission) {
            $permission->title = $request->title;
            $update = $permission->save();
            if ($update) {
                return redirect()->back()->with('success', 'Permission Updated');
            }
            return redirect()->back()->with('error', 'Something Went Wrong !!');
        }
        abort('404');
    }

    public function status(Request $request, $id)
    {
        // abort_if(Gate::denies('permission_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Permission::find($id);
            if ($find) {
                $find->status = $find->status == 1 ? 0 : 1;
                $find->save();
                return response()->json(['success' => true, 'message' => 'Permission Status Changed'], 200);
            }
            return response()->json(['success' => false, 'message' => 'Permission Not Found'], 404);
        }
        abort(403);
    }

    public function destroy(Request $request, $id)
    {
        // abort_if(Gate::denies('permission_destroy'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Permission::find($id);
            if ($find) {
                $find->delete();
                return response()->json(['success' => true, 'message' => 'Permission Deleted'], 200);
            }
            return response()->json(['success' => false, 'message' => 'Permission Not Found'], 404);
        }
        abort(403);
    }

    public function permanentDelete(Request $request, $id)
    {
        // abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Permission::onlyTrashed()->find($id);
            if ($find) {
                $find->forceDelete();
                return response()->json(['success' => true, 'message' => 'Permission Deleted Permanently'], 200);
            }
            return response()->json(['success' => false, 'message' => 'Permission Not Found'], 404);
        }
        abort(403);
    }

    public function restore(Request $request, $id)
    {
        // abort_if(Gate::denies('permission_restore'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $id = base64_decode($id);
        if ($request->ajax()) {
            $find = Permission::onlyTrashed()->find($id);
            if ($find) {
                $find->restore();
                return response()->json(['success' => true, 'message' => 'Permission Restored'], 200);
            }
            return response()->json(['success' => false, 'message' => 'Permission Not Found'], 404);
        }
        abort(403);
    }

    public function search(Request $request, $items = 10)
    {
        // abort_if(Gate::denies('permission_search'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data['items'] = $items;
        $from = date($request->from . " 00:00:00");
        $to = date($request->to . " 00:00:00");
        // dd([$from, $to]);

        $data['list'] = Permission::query();

        if ($request->input('search')) {
            $data['list'] =  $data['list']->where('title', 'LIKE', '%' . $request->input('search') . '%');
        }

        if ($request->from && $request->to) {
            $data['list'] = $data['list']->whereBetween('created_at', [$from, $to]);
        }

        $data['list'] = $data['list']->orderBy('created_at', 'DESC')->withTrashed()->paginate($items);
        $data['list']->appends(['search' => $request->input('search'), 'from' => $request->from, 'to' => $request->to]);
        $data['url'] = '/admin/search-permission/';
        $data['query'] = '?search=' . $request->input('search') . '&from=' . $request->from . '&to=' . $request->to;
        // $data['query'] = explode('?', url()->full())[1];
        return view('admin.user-management.permission.index', $data);
    }
}
