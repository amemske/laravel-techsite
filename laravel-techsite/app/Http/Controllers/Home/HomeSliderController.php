<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeSliderController extends Controller
{
    public function createSlider () {
        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeslide'));
    }
    public function updateSlider (Request $request) {
        $slide_id = $request->id;
        if($request->file('home_slide')){
            $image = $request->file('home_slide');
            //create unique name and add extension
            $name_gen = hexdec(uniqid()) . '.' .$image->getClientOriginalExtension(); //4556.jpg

            //resize using image intervention, save to folder
            Image::make($image)->resize(636,852)->save('upload/home_slider/'.$name_gen);

            //save image url  to db
            $save_url = 'upload/home_slider/'.$name_gen;

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' =>  $request->short_title,
                'video_url' =>  $request->video_url,
                'home_slide' => $save_url
            ]);
            $notification = array(
                'message' => 'Admin profile updated successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);

        } else{
            //only update without image
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' =>  $request->short_title,
                'video_url' =>  $request->video_url,
            ]);
            $notification = array(
                'message' => 'Admin profile without image updated successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }

    }

}
