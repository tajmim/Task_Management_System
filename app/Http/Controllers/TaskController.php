<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create_task(Request $request){
        $task = new Task;
        $task->task_name = $request->task_name; 
        $task->task_description = $request->task_description; 
        $task->assign_to = $request->developer_id; 
        $task->deadline = $request->deadline; 
        $task->project_id = $request->project_id; 
        $task->status = "pending"; 
        $task->assigned_date = now()->format('Y-m-d'); 
        $task->assign_by = Auth::guard('manager')->user()->id; 
        $task->save();
        return redirect()->back()->with('message','task added successfully');







































  }


  public function update_status_task(Request $request,$id){
    $task = Task::find($id);
    $task->status = $request->status;
    $task->save();
    return redirect()->back()->with('message','task updated succesfully');
  }
}
