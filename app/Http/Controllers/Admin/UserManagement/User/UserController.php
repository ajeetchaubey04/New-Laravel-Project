<?php

namespace App\Http\Controllers\Admin\UserManagement\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index($items = 10)
    {
        // abort_if(Gate::denies('user_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['items'] = $items;
        $data['lists'] = User::whereHas(
            'roles',
            function ($q) {
                $q->where('id', 1);
            }
        )->orderBy('id', 'ASC')->withTrashed()->paginate($items);
        $data['roles'] = Role::select('id', 'title')->whereStatus(1)->orderBy('title', 'ASC')->get();
        $data['page_title'] = 'Users List';
        $data['page_description'] = 'Users List';
        return view('admin.user-management.user.index', $data);
    }

    public function store(Request $request)
    {
        // abort_if(Gate::denies('user_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->validate($request, [
            'name'      =>   'required',
            'phone'     =>   'min:10|max:10|unique:users',
            'email'     =>   'required|email|unique:users',
            'password'  =>   'required|min:8',
            'roles'     =>   'required|array'
        ]);

        $insert = [
            'name'      => $request->name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ];
        $save = User::Create($insert);
        if ($save) {
            $save->roles()->sync($request->input('roles', []));
            return redirect()->back()->with('success', 'User Added');
        }
        return redirect()->back()->with('error', 'Something Went wrong');
    }

    public function edit(Request $request, $id)
    {
        // abort_if(Gate::denies('user_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = User::with('roles')->find($id);
            if ($find) {
                $data['user'] = $find;
                $data['roles'] = Role::select('id', 'title')->whereStatus(1)->orderBy('title', 'ASC')->get();
                return response()->json(['success' => true, 'message' => 'Edit User', 'data' => view('admin.user-management.user.edit', $data)->render()]);
            }
            return response()->json(['success' => false, 'message' => 'User Not Found'], 404);
        }
        abort(403);
    }

    // public function update(Request $request)
    // {
    //     // abort_if(Gate::denies('user_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $id = base64_decode($request->id);

    //     $this->validate($request, [
    //         'name'      =>   'required',
    //         'phone'     =>   'min:10|max:10|unique:users,phone,' . $id . ',id',
    //         'email'     =>   'required|email|unique:users,email,' . $id . ',id',
    //         'roles'     =>   'required|array'
    //     ]);

    //     $find = User::find($id);
    //     if ($find) {
    //         $find->name     = $request->name;
    //         $find->email    = $request->email;
    //         $find->phone    = $request->phone;
    //         if ($request->password) {
    //             $find->password    = Hash::make($request->password);
    //         }
    //         $find->save();
    //         $find->roles()->sync($request->input('roles', []));
    //         return redirect()->back()->with('success', 'User Updated');
    //     }
    //     return redirect()->back()->with('error', 'Something Went wrong');

    //     abort('404');
    // }

    // public function status(Request $request, $id)
    // {
    //     // abort_if(Gate::denies('user_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     if ($request->ajax()) {
    //         $id = base64_decode($id);
    //         $find = User::find($id);
    //         if ($find) {
    //             $find->status = $find->status == 1 ? 0 : 1;
    //             $find->save();
    //             return response()->json(['success' => true, 'message' => 'User Status Changed'], 200);
    //         }
    //         return response()->json(['success' => false, 'message' => 'User Not Found'], 404);
    //     }
    //     abort(403);
    // }

    // public function destroy(Request $request, $id)
    // {
    //     // abort_if(Gate::denies('user_destroy'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     if ($request->ajax()) {
    //         $id = base64_decode($id);
    //         $find = User::find($id);
    //         if ($find) {
    //             $find->delete();
    //             return response()->json(['success' => true, 'message' => 'User Deleted'], 200);
    //         }
    //         return response()->json(['success' => false, 'message' => 'User Not Found'], 404);
    //     }
    //     abort(403);
    // }

    // public function permanentDelete(Request $request, $id)
    // {
    //     // abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     if ($request->ajax()) {
    //         $id = base64_decode($id);
    //         $find = User::onlyTrashed()->find($id);
    //         if ($find) {
    //             $find->forceDelete();
    //             return response()->json(['success' => true, 'message' => 'User Deleted Permanently'], 200);
    //         }
    //         return response()->json(['success' => false, 'message' => 'User Not Found'], 404);
    //     }
    //     abort(403);
    // }

    // public function restore(Request $request, $id)
    // {
    //     // abort_if(Gate::denies('user_restore'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     if ($request->ajax()) {
    //         $id = base64_decode($id);
    //         $find = User::onlyTrashed()->find($id);
    //         if ($find) {
    //             $find->restore();
    //             return response()->json(['success' => true, 'message' => 'User Restored'], 200);
    //         }
    //         return response()->json(['success' => false, 'message' => 'User Not Found'], 404);
    //     }
    //     abort(403);
    // }
}
