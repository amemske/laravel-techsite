<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function allPortfolio(){
        //access the db
        //get all data
        //display on a view on the admin side
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all', compact('portfolio'));
    }

    public function createPortfolio(){
        return view('admin.portfolio.portfolio_create');
    }
    public function storePortfolio(Request $request){
        //validate the fields
        // Add custom messages to the validation
        //on the blade display the error messages using @error
        //Rename, resize and save image
        //insert data into the db using insert()
        //Once data is inserted send a notification

        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ],[
            'portfolio_name.required' => 'Portfolio name is required',
            'portfolio_title.required' => 'Portfolio title is required',
        ]);
        $image = $request->file('portfolio_image');
        //create unique name and add extension
        $name_gen = hexdec(uniqid()) . '.' .$image->getClientOriginalExtension(); //4556.jpg

        //resize using image intervention, save to folder
        Image::make($image)->resize(1020,512)->save('upload/portfolio/'.$name_gen);

        //save image url  to db
        $save_url = 'upload/portfolio/'.$name_gen;

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' =>  $request->portfolio_title,
            'portfolio_description' =>  $request->portfolio_description,
            'portfolio_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Portfolio added successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.portfolio')->with($notification);

    }
}
