<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['permission:superAdmin']);
    }

    public function manageAdmin(){
        return view('admin.PersonMaster.admin-manager');
    }
    public function manageAdd(){
        return view('admin.PersonMaster.admin-add');
    }
    public function userManage(){
        return view('admin.PersonMaster.user-manager');
    }
    public function userAdd(){
        return view('admin.PersonMaster.user-add');
    }
    public function qualifyManage(){
        return view('admin.PersonMaster.qualify-manager');
    }
    public function userSummary(){
        return view('admin.PersonMaster.user-summary');
    }
}
