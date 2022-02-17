<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function companyManage(){
        return view('admin.CompanyMaster.company-manager');
    }
    public function companyAdd(){
        return view('admin.CompanyMaster.company-add');
    }
}
