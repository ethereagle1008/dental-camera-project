<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function siteManage(){
        $data = Site::with('company')->get();
        return view('admin.SiteMaster.site-manager', compact('data'));
    }
    public function siteAdd(){
        $company = Company::all();
        return view('admin.SiteMaster.site-add', compact('company'));
    }
    public function siteEdit($id){
        $data = Site::with('company')->find($id);
        $company = Company::all();
        return view('admin.SiteMaster.site-add', compact('data', 'company'));
    }
    public function siteDelete(Request $request){
        Site::where('id', $request->id)->delete();
        return response()->json(['status' => true]);
    }

    public function siteSave(Request $request){
        if(isset($request->id)){
            Site::where('id', $request->id)->update(['name' => $request->name, 'address' => $request->address, 'site_code' => $request->site_code, 'status' => $request->status,
                'latitude' => $request->latitude, 'longitude' => $request->longitude, 'company_id' => $request->company_id, 'contact' => $request->contact]);
        }
        else{
            Site::create(['name' => $request->name, 'address' => $request->address, 'site_code' => $request->site_code, 'status' => $request->status,
                'latitude' => $request->latitude, 'longitude' => $request->longitude, 'company_id' => $request->company_id, 'contact' => $request->contact]);
        }
        return response()->json(['status' => true]);
    }
}
