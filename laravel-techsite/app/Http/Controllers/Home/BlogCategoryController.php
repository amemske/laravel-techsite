<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class BlogCategoryController extends Controller
{
    public function allBlogCategory()
    {
        //access the db
        //get all the data
        //pass data to the view
        $blogCategory = BlogCategory::latest()->get();
        return view('admin.blog_category.blog_category_all', compact('blogCategory'));
    }//end method

    public function addBlogCategory(){
        return view('admin.blog_category.blog_category_add');
    }

    public function storeBlogCategory(Request $request){
        //validate the fields
        // Add custom messages to the validation
        //on the blade display the error messages using @error
        //insert data into the db using insert()
        //Once data is inserted send a notification

        $request->validate([
            'blog_category' => 'required',
        ], [
            'blog_category.required' => 'Blog category name is required',
        ]);


        BlogCategory::insert([
            'blog_category' => $request->blog_category
        ]);
        $notification = array(
            'message' => 'Blog Category added successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.blog.category')->with($notification);

    }//end method

    public function editBlogCategory($id){
        //find 1 with this id from the db
        //create a view for the edit page and pass the data of that single id
        $blogcategory = BlogCategory::findOrFail($id);
        return view('admin.blog_category.blog_category_edit', compact('blogcategory'));
    }// end method

    public function updateBlogCategory(Request $request ,$id){
        //*** Note this is an alternative method od updating without using a hidden input in the blade view****
        //NOTE**** in the alternative method we passed the id through the url $portfolio_id = $request->id;*******

        //get requested id from the edit page
        //use update method to update that specific id
        //send notification

            BlogCategory::findOrFail($id)->update([
                'blog_category' => $request->blog_category,
            ]);
            $notification = array(
                'message' => 'Blog category updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog.category')->with($notification);

    }//end method
    public function deleteBlogCategory($id){
        BlogCategory::findOrFail($id)->delete(); //delete the db row with this id
        $notification = array(
            'message' => 'Blog category deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }
}
