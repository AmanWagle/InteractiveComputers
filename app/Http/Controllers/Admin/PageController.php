<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.website_page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.website_page.form');
    }

    public function getAllPages()
    {
        $pages = Page::all();
        return response()->json(['data' => $pages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'short_description' => "required",
            'description' => "required",
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $page = Page::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description
        ]);

        $imageName = $this->uploadOne($request->file('thumbnail'));

        $page->update([
            'thumbnail' => $imageName
        ]);

        return response()->json(['success' => true, 'message' => 'Page added successfully!']);
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
        $page = Page::find($id);
        return view('admin.pages.website_page.form', compact('page'));
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
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
        ];

        if($request->hasFile('thumbnail')){
            $rules['thumbnail'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $request->validate($rules);

        $page = Page::find($id);
        $imageName = $page->thumbnail;
        if ($request->hasFile('thumbnail') && $request->thumbnail != '') {
            $image_path = "/images/uploads/{$page->thumbnail}";
            $this->deleteFile($image_path);
            $imageName = $this->uploadOne($request->file('thumbnail'));
        }

        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'thumbnail' => $imageName,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description
        ]);

        return response()->json(['success' => true, 'message' => 'Page updated successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        if (!$page)
            return response()->json(['success' => false, 'message' => 'Page doesnot exist']);

        $page->delete();
        return response()->json(['success' => true, 'message' => 'Page is deleted']);
    }
}
