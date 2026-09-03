<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:edit_website_page']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Banner::where('position', 'slider')->orderBy('created_at', 'asc')->get();
        $side_boxes = Banner::where('position', 'side_box')->orderBy('created_at', 'asc')->get();

        return view('backend.marketing.banners.index', compact('sliders', 'side_boxes'));
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
            'image' => 'required',
            'position' => 'required|in:slider,side_box',
        ]);

        if ($request->position == 'side_box' && Banner::where('position', 'side_box')->count() >= 2) {
            flash(translate('Maximum 2 side banners are allowed'))->error();
            return back();
        }

        $banner = new Banner;
        $banner->image = $request->image;
        $banner->link = $request->link;
        $banner->position = $request->position;
        $banner->title = $request->title;
        $banner->status = 1;
        $banner->save();

        Cache::forget('home.banners');
        Cache::forget('home.side_banners');

        flash(translate('Banner has been inserted successfully'))->success();
        return back();
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
        $banner = Banner::findOrFail($id);
        $banner->image = $request->image;
        $banner->link = $request->link;
        $banner->title = $request->title;
        $banner->save();

        Cache::forget('home.banners');
        Cache::forget('home.side_banners');

        flash(translate('Banner has been updated successfully'))->success();
        return back();
    }

    /**
     * Update the status of the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update_status(Request $request)
    {
        $banner = Banner::findOrFail($request->id);
        $banner->status = $request->status;
        $banner->save();

        Cache::forget('home.banners');
        Cache::forget('home.side_banners');

        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::destroy($id);

        Cache::forget('home.banners');
        Cache::forget('home.side_banners');

        flash(translate('Banner has been deleted successfully'))->success();
        return back();
    }
}
