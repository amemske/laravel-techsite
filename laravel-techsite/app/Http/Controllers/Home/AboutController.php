<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\HomeSlide;
use App\Models\MultiImage;
use Carbon\Carbon;
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

            //create save url
            $save_url = 'upload/home_about/'.$name_gen;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' =>  $request->short_title,
                'short_description' =>  $request->short_description,
                'long_description' =>  $request->long_description,
                'about_image' => $save_url //save to db
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
    public function aboutMultiImage () {

        return view('admin.about_page.multi_image');
    }
    public function storeMultiImage (Request $request) {
        //get the image from the form
    $image = $request->file('multi_image');

        foreach ($image as $multi_image){
   // loop through the images
    //create unique name and add extension
            $name_gen = hexdec(uniqid()) . '.' .$multi_image->getClientOriginalExtension(); //4556.jpg

            //resize using image intervention, save to folder
            Image::make($multi_image)->resize(220,220)->save('upload/multi/'.$name_gen);

            //create save url
            $save_url = 'upload/multi/'.$name_gen;

            MultiImage::insert([
                'multi_image' => $save_url, //save to db : db column name is multi_image
                'created_at' => Carbon::now(),
            ]);

        } //end loop

        $notification = array(
            'message' => 'Multi images inserted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.multi.image')->with($notification);

    }

    public function allMultiImage(){
        $allMultiImage = MultiImage::all(); //get all from db
        return view('admin.about_page.all_multi_image', compact('allMultiImage'));
    }
    public function editMultiImage($id){
        //find the specific id in the db
        //return the view with data only of that id
        $multiImage = MultiImage::findOrFail($id);
        return view('admin.about_page.edit_multi_image', compact('multiImage'));
    }
    public function updateMultiImage(Request $request){
        $multi_image_id = $request->id; //coming from the hidden field in the blade
        if($request->file('multi_image')){
            $image = $request->file('multi_image');
            //create unique name and add extension
            $name_gen = hexdec(uniqid()) . '.' .$image->getClientOriginalExtension(); //4556.jpg

            //resize using image intervention, save to folder
            Image::make($image)->resize(220,220)->save('upload/multi/'.$name_gen);

            //create save url
            $save_url = 'upload/multi/'.$name_gen;

            MultiImage::findOrFail($multi_image_id)->update([
                'multi_image' => $save_url //save to db
            ]);
            $notification = array(
                'message' => 'Multi Image updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.multi.image')->with($notification);

        };


        }

    public function deleteMultiImage($id) {
        //get the data from db from id
    //access the field multi_image
        //unlink
        //delete

        $multi = MultiImage::findOrFail($id);
         $image = $multi ->multi_image;
        unlink($image); //delete the file

        MultiImage::findOrFail($id)->delete(); //delete the db row with the image
        $notification = array(
            'message' => 'Multi Image deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.multi.image')->with($notification);
    } //end method

}
