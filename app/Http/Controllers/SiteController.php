<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function siteManage(){
        return view('admin.SiteMaster.site-manager');
    }
    public function siteAdd(){
        return view('admin.SiteMaster.site-add');
    }
}
