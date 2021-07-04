<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
use App\Models\Banner;
use App\Models\BannerImage;
use Illuminate\Http\Request;

class BannerImageController extends Controller
{
    use UploadTrait;

    //store new image
    public function store($banner_id, Request $request)
    {
        $banner = Banner::find($banner_id);
        if (!$banner) return response()->json(['success' => false, 'message' => "Banner doesn't exists."]);

        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $banner = BannerImage::create([
            'link' => $request->link,
            'status' => $request->status ? 1 : 0,
            'banner_id' => $banner_id,
        ]);

        $imageName = $this->uploadOne($request->file('image'));

        $banner->update([
            'name' => $imageName
        ]);

        return response()->json(['success' => true, 'message' => "Banner added successfully"]);
    }

    //delete image
    public function destroy($banner_id, $id)
    {
        $banner = Banner::find($banner_id);
        if (!$banner) return response()->json(['success' => false, 'message' => "Banner doesn't exists."]);

        $banner_image = BannerImage::find($id);
        $image_path = "/images/uploads/{$banner_image->name}";
        $this->deleteFile($image_path);
        $banner_image->delete();
        return response()->json(['success' => true, 'message' => "Banner Image deleted successfully"]);
    }
}
