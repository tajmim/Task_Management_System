<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function manage_projects(){
        $projects = Project::leftjoin('managers', 'projects.created_by', 'managers.id')
        ->select('projects.*','managers.name as created_by')
        ->get();
        return view('manager.manage_projects' , compact('projects'));
    }

    public function store_project(Request $request){
        
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'desc' => 'required|string',
                'start_date' => 'required',
                'end_date' => 'required',
                
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->with(['error' => $validator->errors()], 400);
            }
        $project = new Project;
        $project->project_title = $request->title;
        $project->project_description = $request->desc;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->created_by = Auth::guard('manager')->user()->id;
        $project->status = 1;
        $project->save();
        return redirect()->back()->with('message','project created successfully');
    }

    public function project_details($id){
        $project = Project::where('projects.id', $id)
        ->leftjoin('managers', 'managers.id','projects.created_by')
        ->select('projects.*','managers.name as created_by')
        ->first();
        // dd($project);
        $not_assigned_developers = Developer::all();
        $assigned_developers = Developer::rightjoin('project_developers','project_developers.developer_id','developers.id')
        ->select('developers.*')
        ->get();
        return view('manager.project_details',compact('project','not_assigned_developers','assigned_developers'));
    }


    public function add_developer_to_project(Request $request, $id){
        $data = DB::table('project_developers')->where('project_id',$id)->where('developer_id',$request->developer_id)->first();
        if($data){
            return redirect()->back()->with('message','This developer already added');
        }
        DB::table('project_developers')->insert(['project_id'=>$id,'developer_id'=>$request->developer_id]);
        return redirect()->back()->with('message','Developer added Successfully');
    }

    
}
