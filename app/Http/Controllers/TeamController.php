<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    //
    public function teamManage(){
        return view('admin.TeamMaster.team-manager');
    }
    public function teamAdd(){
        return view('admin.TeamMaster.team-add');
    }
}
