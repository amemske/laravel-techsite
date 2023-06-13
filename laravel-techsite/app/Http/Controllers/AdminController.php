<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
//        This logs out the currently authenticated user by calling the logout method on the Auth facade with the 'web' guard,
//        which is the default guard for web authentication in Laravel. This effectively ends the user's session
//         and removes their authenticated status

        $request->session()->invalidate();

        $request->session()->regenerateToken();
//        This generates a new CSRF token for the user's session by calling the regenerateToken method on the request's session object.
//        This ensures that any forms or actions performed by the user after logging out will have a fresh CSRF token, which helps prevent
//        cross-site request forgery attacks.

        $notification = array(
            'message' => 'Logged out!',
            'alert-type' => 'info'
        );
        return redirect('/login')->with($notification);
    }

    public function profile() {
        if (auth()->check()){
            //get the id
            $id = Auth::user()->id;
            $adminData = User::find($id);
            return view('admin.admin_profile_view', compact('adminData'));
        } else{
            return redirect()->route('login');
        }


    }
    public function editProfile() {
        if (auth()->check()) {
            //get the id
            $id = Auth::user()->id;
            $editData = User::find($id);
            return view('admin.admin_profile_edit', compact('editData'));
        }else{
            return redirect()->route('login');
        }

    }
    public function storeProfile(Request $request)
    {
            if (auth()->check()) {
                $id = Auth::user()->id;
                $storeData = User::find($id);
                $storeData->name = $request->name;
                $storeData->email = $request->email;
                $storeData->username = $request->username;

            if ($request->file('profile_image')) {
                $file = $request->file('profile_image');
                //change image name
                $filename = date('YmdHi') . $file->getClientOriginalName();
                //store the file
                $file->move(public_path('upload/admin_images'), $filename);
                $storeData['profile_image'] = $filename;
            }
            $storeData->save();
            $notification = array(
                'message' => 'Admin profile updated successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('admin.profile')->with($notification);
    } else{
            return redirect()->route('login');
        }
    }


}
