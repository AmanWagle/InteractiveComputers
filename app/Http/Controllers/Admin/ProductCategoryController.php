<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.product_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.product_category.form');
    }

    public function getAllCategories()
    {
        $product_categories = ProductCategory::all();
        return response()->json(['data' => $product_categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'parent_id' => 'numeric',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $request->validate($rules);

        $product_category = ProductCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'parent_id' => $request->parent_id,
            'status' => ($request->status) ? 1 : 0,
            'is_featured' => ($request->is_featured) ? 1 : 0,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);

        $imageName = $this->uploadOne($request->file('icon'));

        $product_category->update([
            'icon' => $imageName
        ]);

        return response()->json(['success' => true, 'message' => 'Category added successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_category = ProductCategory::find($id);
        return view('admin.pages.product_category.form', compact('product_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'parent_id' => 'numeric',
        ];

        if ($request->hasFile('icon')) {
            $rules['icon'] = '|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $request->validate($rules);

        $product_category = ProductCategory::find($id);
        $imageName = $product_category->icon;

        if ($request->hasFile('icon')) {
            $image_path = "/images/uploads/{$product_category->icon}";
            $this->deleteFile($image_path);
            $imageName = $this->uploadOne($request->file('icon'));
        }

        $product_category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'parent_id' => $request->parent_id,
            'status' => ($request->status) ? 1 : 0,
            'is_featured' => ($request->is_featured) ? 1 : 0,
            'icon' => $imageName,

            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);

        return response()->json(['success' => true, 'message' => 'Category updated successfully!']);
    }

    public function updateStatusOrFeatured(Request $request, $id)
    {
        $product_category = ProductCategory::find($id);
        $product_category->update([
            'status' => ($request->status) ? 1 : 0,
            'is_featured' => ($request->is_featured) ? 1 : 0,
        ]);

        $action = ($request->is_featured == 1) ? 'enabled' : 'disabled';

        return response()->json(['success' => true, 'message' => "Category successfully {$action}"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_category = ProductCategory::find($id);
        if (!$product_category) return response()->json(['success' => false, 'message' => "Category doesn't exists."]);

        $product_category->delete();
        return response()->json(['success' => true, 'message' => "Category deleted successfully"]);
    }
}
