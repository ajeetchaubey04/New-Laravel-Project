<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Traits\FileUploadTrait;

class ProductController extends Controller
{
    use  FileUploadTrait;
    public function index(Request $request, $items = 10)
    {
        $data['items'] = $items;
        $data['lists'] = Product::orderBy('id','desc')->withTrashed()->paginate((int)$items);
        $lists = Product::all();
        $data['page_title'] = 'Products List';
        $data['page_description'] = 'Products List';
        // dd($data['lists']);

            return view('admin.products.index', $data);

    }

    public function store(Request $request)
    {
        // abort_if(Gate::denies('product_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->validate($request, [
            'name'         =>   'required',
            'description'   =>   'required',
            'price'         =>    'required',
            'quantity'      =>     'required'
        ]);

        $insert = [
            'name'         => $request->name,
            'description'   => $request->description,
            'price'         =>$request->price,
            'quantity'      =>$request->quantity,
        ];

        $save = Product::create($insert);
        if ($save) {

            if ($request->file('request_featured_product')) {
                $file = $this->uploadFile('uploads/product/featured-product/', $request->file('request_featured_product'), false);
                Image::create(['product_id' => $save->id, 'file' => $file, 'type' => 'featured_product']);
            }
            return redirect()->back()->with('success', 'Product Added');
        }
        return redirect()->back()->with('error', 'Something Went wrong');
    }

    public function edit(Request $request, $id)
    {
        // abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Product::find($id);
            if ($find) {
                $data['product'] = $find;
                return response()->json(['success' => true, 'message' => 'Products Edit', 'data' => view('admin.products.edit', $data)->render()]);
            }
            return response()->json(['success' => false, 'message' => ' Not Found'], 404);
        }
        abort(403);
    }

    public function update(Request $request)
    {
        // abort_if(Gate::denies('product_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = base64_decode($request->id);

        $this->validate($request, [
            'name'              =>  'required',
            'description'       => 'required',
            'price'             =>  'required',
            'quantity'          => 'required',

        ]);

        $find = Product::find($id);
        if ($find) {
            $find->name             = $request->name;
            $find->description      = $request->description;
            $find->price            = $request->price;
            $find->quantity         = $request->quantity;
            $find->save();

            if ($request->file('request_featured_product')) {
                $file = $this->uploadFile('uploads/product/featured-product/', $request->file('request_featured_product'), false);
                Image::create(['product_id' => $id, 'file' => $file, 'type' => 'featured_product']);
            }

            return redirect()->back()->with('success', 'Product Updated');
        }
        return redirect()->back()->with('error', 'Product Not Found');
    }


    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Product::find($id);
            if ($find) {
                $find->delete();
                return response()->json(['success' => true, 'message' => 'Header Deleted'], 200);
            }
            return response()->json(['success' => false, 'message' => 'Header Not Found'], 404);
        }
        abort(403);
    }

    public function permanentDelete(Request $request, $id)
    {
        // abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Product::onlyTrashed()->find($id);
            if ($find) {
                $find->forceDelete();
                return response()->json(['success' => true, 'message' => 'Header Deleted Permanently'], 200);
            }
            return response()->json(['success' => false, 'message' => 'Header Not Found'], 404);
        }
        abort(403);
    }

    public function restore(Request $request, $id)
    {
        // abort_if(Gate::denies('permission_restore'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $id = base64_decode($id);
            $find = Product::onlyTrashed()->find($id);
            if ($find) {
                $find->restore();
                return response()->json(['success' => true, 'message' => 'Header Note Restored'], 200);
            }
            return response()->json(['success' => false, 'message' => 'Header Note Not Found'], 404);
        }
        abort(403);
    }
}
