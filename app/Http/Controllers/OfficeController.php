<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficeController extends Controller
{
    //
    public function officeManage(){
        return view('admin.OfficeMaster.office-manager');
    }
    public function officeAdd(){
        return view('admin.OfficeMaster.office-add');
    }
}
