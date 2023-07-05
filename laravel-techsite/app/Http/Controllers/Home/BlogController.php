<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function allBlog()
    {
        //access the db
        //get all data
        //display on a view on the admin side
        $blogs = Blog::latest()->get();
        return view('admin.blogs.blogs_all', compact('blogs'));
    }//end method
    public function addBlog()
    {
        $blogCategories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blogs.blogs_add', compact('blogCategories'));
    }//end method
    public function storeBlog(Request $request)
    {
        //validate the fields
        // Add custom messages to the validation
        //on the blade display the error messages using @error
        //insert data into the db using insert()
        //Once data is inserted send a notification
        //Rename, resize and save image

        $image = $request->file('blog_image');
        //create unique name and add extension
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //4556.jpg

        //resize using image intervention, save to folder
        Image::make($image)->resize(430, 327)->save('upload/blog/' . $name_gen);

        //save image url  to db
        $save_url = 'upload/blog/' . $name_gen;

        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_tags' => $request->blog_tags,
            'blog_description' => $request->portfolio_description,
            'blog_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog added successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.blog')->with($notification);
    }//end method

    public function editBlog($id)
    {
        //find 1 with this id from the db
        //create a view for the edit page and pass the data of that single id
        //pass in the categories that are selected
        $blog = Blog::findOrFail($id);
        $blogCategories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blogs.blogs_edit', compact('blog','blogCategories' ));

    }//end method

    public function updateBlog (Request $request){
        //get requested id from the edit page
        //check if image exists
        //rename, resize image
        //use update method to update that specific id
        //send notification
        $blog_id = $request->id;
        if ($request->file('blog_image')) {
            $image = $request->file('blog_image');
            //create unique name and add extension
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //4556.jpg

            //resize using image intervention, save to folder
            Image::make($image)->resize(430, 327)->save('upload/blog/' . $name_gen);

            //save image url  to db
            $save_url = 'upload/blog/' . $name_gen;

            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
                'blog_image' => $save_url
            ]);
            $notification = array(
                'message' => 'Blog updated with image successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog')->with($notification);
        } else {
            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
            ]);
            $notification = array(
                'message' => 'Blog updated without image successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog')->with($notification);
        }
    }//end method

    public function deleteBlog($id) {
         //get the data from db from id
        //access the field multi_image
        //unlink delete image
        // delete the db row with the image
        //show notification
        //using back() stay on the same page

        $blog = Blog::findOrFail($id);
        $image = $blog->blog_image;
        unlink($image); //delete the file

        Blog::findOrFail($id)->delete(); //delete the db row with the data
        $notification = array(
            'message' => 'Blog Image deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //end method

    public function blogDetails($id){
        //get data of that specific id
        $allBlogs = Blog::latest()->limit(5)->get();
        $blog = Blog::findOrFail($id);
        $blogCategories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('frontend.blog_details', compact('blog', 'allBlogs', 'blogCategories'));
    }//end method

    public function CategoryBlog($id){
        //get all posts where the requested id (category is) matches the blog_category_id
        $blogpost = Blog::where('blog_category_id', $id)->orderBy('id', 'DESC')->get();
        $allBlogs = Blog::latest()->limit(5)->get();
        $blogCategories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $chosenCategories = BlogCategory::findOrFail($id);
        return view('frontend.cat_blog_details', compact('blogpost', 'allBlogs', 'blogCategories', 'chosenCategories'));

    }//end method

    public function mainBlog(){
        $blogCategories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $allBlogs = Blog::latest()->limit(5)->get();

        return view('frontend.blog', compact( 'allBlogs', 'blogCategories', 'allBlogs'));

    }
}
