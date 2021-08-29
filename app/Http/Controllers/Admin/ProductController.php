<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.product.form');
    }

    public function getAllProducts()
    {
        $products = Product::paginate(10);
        return response()->json(['data' => $products]);
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
            'name' => 'required|unique:products',
            'product_code' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'original_price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
        ];
        if ($request->discount) {
            $rules['selling_price'] = 'required|numeric';
        }
        if ($request->hasFile('product_image')) {
            $rules['product_image.*'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $request->validate($rules);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'product_code' => $request->product_code,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'stock' => $request->stock,
            'original_price' => $request->original_price,
            'discount' => ($request->discount) ? 1 : 0,
            'selling_price' => $request->selling_price,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'status' => ($request->status) ? 1 : 0,
            'is_featured' => ($request->is_featured) ? 1 : 0,
            'specifications' => $request->specifications,
            'weight' => $request->weight,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);

        if ($request->hasFile('product_image')) {
            $product_images = $request->file('product_image');

            $image_names = array();
            foreach ($product_images as $p_image) {
                $image_names[] = $this->uploadOne($p_image);
            }
            $image_name_string = implode(', ', $image_names);

            $product->update([
                'product_images' => $image_name_string
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Product added successfully!']);
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
        $product = Product::find($id);
        return view('admin.pages.product.form', compact('product'));
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
            'product_code' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'original_price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
        ];
        if ($request->discount) {
            $rules['selling_price'] = 'required|numeric';
        }
        if ($request->hasFile('product_image')) {
            $rules['product_image.*'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $request->validate($rules);

        $product = Product::find($id);
        $image_name_string = $product->product_images;

        if ($request->hasFile('product_image')) {
            //deleting existing image if new images are uploaded.
            foreach ($product->product_images_array as $image) {
                $existing_image_path = "/images/uploads/{$image}";
                $this->deleteFile($existing_image_path);
            }
            //uploading new images
            $new_product_images = $request->file('product_image');

            $image_names = array();
            foreach ($new_product_images as $p_image) {
                $image_names[] = $this->uploadOne($p_image);
            }
            //replacing old image name string with new image name string
            $image_name_string = implode(', ', $image_names);
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'product_code' => $request->product_code,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'stock' => $request->stock,
            'original_price' => $request->original_price,
            'discount' => ($request->discount) ? 1 : 0,
            'selling_price' => $request->selling_price,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'status' => ($request->status) ? 1 : 0,
            'is_featured' => ($request->is_featured) ? 1 : 0,
            'specifications' => $request->specifications,
            'weight' => $request->weight,
            'length' => $request->length,
            'width' => $request->width,
            'height' => $request->height,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
            'product_images' => $image_name_string
        ]);

        return response()->json(['success' => true, 'message' => 'Product updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['success' => false, 'message' => "Product doesn't exists."]);

        $product->delete();
        return response()->json(['success' => true, 'message' => "Product deleted successfully"]);
    }
}
