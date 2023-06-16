<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public  function contact(){
        return view('frontend.contact');
    }
    public function storeMessage (Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //insert into the database
        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Message sent successfully  ',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); //stay on the same page

    }

    public function getContactMessage() {
        $contact = Contact::latest()->get();
        return view('admin.contact.allcontact', compact('contact'));
    }
}
