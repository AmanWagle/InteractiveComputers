<?php

namespace App\Helpers;

use App\Models\Banner;

class BannerHelper
{
    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }

    public function getBannerImages($banner_slug)
    {
        $banners = $this->banner->with('banner_images')->where('slug', $banner_slug)->first();
        return $banners->banner_images ?? false;
    }
}
