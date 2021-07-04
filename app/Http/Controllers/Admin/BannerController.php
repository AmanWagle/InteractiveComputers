<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getAllBanners()
    {
        $banners = Banner::all();
        return response()->json(['data' => $banners]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:banners,name|max:255'
        ]);

        $banner = Banner::create([
            'name' => $request->name,
            'slug'  => Str::slug($request->name),
            'status' => ($request->status) ? 1 : 0,
        ]);

        return response()->json(['success' => true, 'message' => "Banner added successfully"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = Banner::with('banner_images')->find($id);
        return response()->json(['data' => $banner]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.pages.banner.banner-detail', compact('id'));
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
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $banner = Banner::find($id);
        $banner->update([
            'name' => $request->name,
            'slug'  => Str::slug($request->name),
            'status' => ($request->status) ? 1 : 0,
        ]);

        return response()->json(['success' => true, 'message' => "Banner updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if (!$banner) return response()->json(['success' => false, 'message' => "Banner doesn't exists."]);

        $banner->delete();
        return response()->json(['success' => true, 'message' => "Banner deleted successfully"]);
    }
}
