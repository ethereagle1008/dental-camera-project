<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //
    public function companyManage(){
        $data = Company::all();
        return view('admin.CompanyMaster.company-manager', compact('data'));
    }
    public function companyAdd(){
        return view('admin.CompanyMaster.company-add');
    }
    public function companySave(Request $request){
        if(isset($request->id)){
            Company::where('id', $request->id)->update(['name' => $request->name, 'post_code' => $request->post_code,
                'address' => $request->address, 'phone' => $request->phone, 'fax' => $request->fax, 'email' => $request->email]);
        }
        else{
            Company::create(['name' => $request->name, 'post_code' => $request->post_code,
                'address' => $request->address, 'phone' => $request->phone, 'fax' => $request->fax, 'email' => $request->email]);
        }
        return response()->json(['status' => true]);
    }
    public function companyDelete(Request $request){
        Company::where('id', $request->id)->delete();
        return response()->json(['status' => true]);
    }
}
