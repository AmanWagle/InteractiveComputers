<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
use App\Models\Brand;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.brand.form');
    }

    public function getAllBrands()
    {
        $brands = Brand::all();
        return response()->json(['data' => $brands]);
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
            'name' => 'required|unique:brands',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
        $request->validate($rules);

        $brand = Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
            'status' => ($request->status) ? 1 : 0,
            'is_featured' => ($request->is_featured) ? 1 : 0,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);

        $imageName = $this->uploadOne($request->file('logo'));

        $brand->update([
            'logo' => $imageName
        ]);

        return response()->json(['success' => true, 'message' => 'Brand added successfully!']);
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
        $brand = Brand::find($id);
        return view('admin.pages.brand.form', compact('brand'));
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
            'name' => ['required', Rule::unique('brands')->ignore($id)],
        ];
        if ($request->hasFile('logo')) {
            $rules['logo'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $request->validate($rules);

        $brand = Brand::find($id);

        $imageName = $brand->logo;

        if ($request->hasFile('logo')) {
            $image_path = `/images/uploads/{$brand->icon}`;
            $this->deleteFile($image_path);
            $imageName = $this->uploadOne($request->file('logo'));
        }

        $brand->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'description' => $request->description,
            'status' => ($request->status) ? 1 : 0,
            'is_featured' => ($request->is_featured) ? 1 : 0,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'logo' => $imageName
        ]);

        return response()->json(['success' => true, 'message' => 'Brand updated successfully!']);
    }

    public function updateIsFeatured(Request $request, $id)
    {
        $brand = Brand::find($id);
        $brand->update([
            'is_featured' => ($request->is_featured) ? 1 : 0,
        ]);

        $action = ($request->is_featured == 1) ? 'enabled' : 'disabled';

        return response()->json(['success' => true, 'message' => "Brand successfully {$action}"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if(!$brand) return response()->json(['success' => false, 'message' => "Brand doesn't exists."]);

        $brand->delete();
        return response()->json(['success' => true, 'message' => "Brand deleted successfully"]);
    }
}
