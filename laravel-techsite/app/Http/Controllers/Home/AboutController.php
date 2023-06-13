<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function createAboutPage () {
        $aboutpage = About::find(1);
        return view('admin.about_page.about_page_all', compact('aboutpage'));
    }
    public function updateAboutPage (Request $request) {
        $about_id = $request->id;
        if($request->file('about_image')){
            $image = $request->file('about_image');
            //create unique name and add extension
            $name_gen = hexdec(uniqid()) . '.' .$image->getClientOriginalExtension(); //4556.jpg

            //resize using image intervention, save to folder
            Image::make($image)->resize(523,603)->save('upload/home_about/'.$name_gen);

            //save image url  to db
            $save_url = 'upload/home_about/'.$name_gen;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' =>  $request->short_title,
                'short_description' =>  $request->short_description,
                'long_description' =>  $request->long_description,
                'about_image' => $save_url
            ]);
            $notification = array(
                'message' => 'About page updated successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);

        } else{
            //only update without image
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' =>  $request->short_title,
                'short_description' =>  $request->short_description,
                'long_description' =>  $request->long_description,
            ]);
            $notification = array(
                'message' => 'About page updated successfully  without image',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        }

    }
    public function mainAboutPage () {
        $aboutpage = About::find(1);
        return view('frontend.about_page', compact('aboutpage'));
    }
}
