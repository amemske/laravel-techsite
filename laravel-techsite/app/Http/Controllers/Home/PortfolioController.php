<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use App\Models\MultiImage;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function allPortfolio()
    {
        //access the db
        //get all data
        //display on a view on the admin side
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all', compact('portfolio'));
    }

    public function createPortfolio()
    {
        return view('admin.portfolio.portfolio_create');
    }

    public function storePortfolio(Request $request)
    {
        //validate the fields
        // Add custom messages to the validation
        //on the blade display the error messages using @error
        //insert data into the db using insert()
        //Once data is inserted send a notification
        //Rename, resize and save image

        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ], [
            'portfolio_name.required' => 'Portfolio name is required',
            'portfolio_title.required' => 'Portfolio title is required',
        ]);
        $image = $request->file('portfolio_image');
        //create unique name and add extension
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //4556.jpg

        //resize using image intervention, save to folder
        Image::make($image)->resize(1020, 512)->save('upload/portfolio/' . $name_gen);

        //save image url  to db
        $save_url = 'upload/portfolio/' . $name_gen;

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Portfolio added successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.portfolio')->with($notification);

    } //end method

    public function editPortfolio($id)
    {
        //find 1 with this id from the db
        //create a view for the edit page and pass the data of that single id
        $portfolio = Portfolio::findOrFail($id);
        return view('admin.portfolio.portfolio_edit', compact('portfolio'));

    }

    public function updatePortfolio(Request $request)
    {
        //get requested id from the edit page
        //check if image exists
        //rename, resize image
        //use update method to update that specific id
        //send notification
        $portfolio_id = $request->id;
        if ($request->file('portfolio_image')) {
            $image = $request->file('portfolio_image');
            //create unique name and add extension
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //4556.jpg

            //resize using image intervention, save to folder
            Image::make($image)->resize(1020, 519)->save('upload/portfolio/' . $name_gen);

            //save image url  to db
            $save_url = 'upload/portfolio/' . $name_gen;

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url
            ]);
            $notification = array(
                'message' => 'Portfolio updated  with image successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.portfolio')->with($notification);
        } else {
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
            ]);
            $notification = array(
                'message' => 'Portfolio updated without image successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.portfolio')->with($notification);
        }
    }//end method

    public function deletePortfolio($id) {
        //get the data from db from id
        //access the field multi_image
        //unlink delete image
        // delete the db row with the image
        //show notification
        //using back() stay on the same page

        $portfolip = Portfolio::findOrFail($id);
        $image = $portfolip->portfolio_image;
        unlink($image); //delete the file

        Portfolio::findOrFail($id)->delete(); //delete the db row with the image
        $notification = array(
            'message' => 'Portfolio Image deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //end method

    public function portfolioDetails($id){
        $portfolioDetails = Portfolio::findOrFail($id);
        return view('frontend.portfolio_details', compact('portfolioDetails'));
    }//end method
}
