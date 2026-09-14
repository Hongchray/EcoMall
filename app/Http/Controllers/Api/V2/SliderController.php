<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\SliderCollection;
use App\Models\Banner;
use Cache;

class SliderController extends Controller
{
    public function sliders()
    {
        $images = Banner::where('position', 'slider')
            ->where('status', 1)
            ->orderBy('created_at', 'asc')
            ->pluck('image')
            ->toArray();

        return new SliderCollection($images);
    }

    public function bannerOne()
    {
        return new SliderCollection(get_setting('home_banner1_images') != null ? json_decode(get_setting('home_banner1_images'), true) : []);
    }

    public function bannerTwo()
    {
        return new SliderCollection(get_setting('home_banner2_images') != null ? json_decode(get_setting('home_banner2_images'), true) : []);
    }

    public function bannerThree()
    {
        return new SliderCollection(get_setting('home_banner3_images') != null ? json_decode(get_setting('home_banner3_images'), true) : []);
    }
}
