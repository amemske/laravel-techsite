<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function footerSetup(){
        $allfooter = Footer::find(1);
        return view('admin.footer.footer_all', compact('allfooter'));
    }
}
