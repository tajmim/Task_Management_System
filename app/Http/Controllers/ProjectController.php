<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function manage_projects(){
        return view('manager.manage_projects');
    }
}
