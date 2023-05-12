<?php

namespace App\Http\Controllers;

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

        return redirect('/login');
    }

}
